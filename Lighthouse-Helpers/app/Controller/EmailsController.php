<?php
App::uses('CakeEmail', 'Network/Email');

class EmailsController extends AppController {
	public $uses = array('Application',
						'Role', 
						'AssignedRole', 
						'Person'
	);
	public $name = 'Emails';
	
	private $testmode = false; //with this set to true all emails are send to 'g8hyp@peers.org.uk'=>'Fred Bloggs'
	private $emailhandler = 'smtp'; //set the email handler, 'debug', 'smtp' (running on laptop), 'default' (running on server) 

	public function sendconfirmation() { //send confirmation emails
		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		$confirmations = array(); //initialise array to hold data for confirmation emails
		$results = array('sent'=>0, 'failed'=>0, 'invalidemail'=>0); //initialise array to count send stats
		//setup contain and filter for ok reference this year
		$this->Application->contain(array('Person',
											'Person.Reference' => array('conditions' => array('Reference.Reference_OK =' => -1, 
																								'Reference.Year =' => $lhyear)),
											'AssignedRole',
											'AssignedRole.Role',
											'AssignedRole.Role.RoleLeaderLink',
											'AssignedRole.Role.RoleLeaderLink.Role'											
											));
		$applications = $this->Application->find('all',
					array('fields' => array('Application.Application_ID',
											'Application.tblPerson_Person_ID'),
							'conditions' => array('Application.Year' => $lhyear, //this year
												'Application.Confirmation_email_sent' => 0, //email not sent
												'Application.CRB' => array(0,2) //crb not required or available
												)
					));
		foreach ($applications as $application) : // iterate through all applications to find ones with good refereence and an assigned role
			if (count($application['Person']['Reference']) > 0 && count($application['AssignedRole']) > 0) {
				$confirmations[] = $application; //add an good application to confirmations array
			}
		endforeach;
		
		if ($this->request->is('post') || $this->request->is('put')) { //send emails if the confirm button has been pressed
//			debug('received post');
			if (count($confirmations)>0) { //check to see there are some confirmations to send
				foreach ($confirmations as $confirmation) { //iterate through the confirmations
//					debug($confirmation);
					$confirmationdetails = array(); //init array for details to be sent in email
					foreach ($confirmation['AssignedRole'] as $role) { //iterate through assigned roles
//						debug($role['Role']['RoleLeaderLink']['role_leader_id']);
						//find the group leader's application record
						$leaderapplication = $this->AssignedRole->find('first', array('contain'=>array('Application'=>array('fields'=>array('Application.tblPerson_Person_ID'))),
																					'conditions'=>array('AssignedRole.tblRole_Role_ID' => $role['Role']['RoleLeaderLink']['role_leader_id'],
																										'Application.Year' => $lhyear)));
//						debug($leaderapplication);
						//find the group leaders person record
						$leaderperson = $this->Person->find('first', array('conditions'=>array('Person_ID'=>$leaderapplication['Application']['tblPerson_Person_ID']),
																			'fields'=>array('Person.full_name', 'Person.Telephone_1', 'Person.email'),
																			'recursive'=>0));
//						debug($leaderperson);
						//populate the array with details for the table in the email
						$confirmationdetails[] = array('RoleName' => $role['Role']['RoleName'],
														'LeaderRole' => $role['Role']['RoleLeaderLink']['Role']['RoleName'],
														'LeaderName' => $leaderperson['Person']['full_name'],
														'LeaderPhone' => $leaderperson['Person']['Telephone_1'],
														'LeaderEmail' => $leaderperson['Person']['email']);
					}
					//check that the helper has a valid email address
					if(Validation::email($confirmation['Person']['email'])){
						//if email is valid start to send the email
//						debug('Valid email');
//						debug($this->emailhandler);
						$email = new CakeEmail($this->emailhandler); //set the email method
						$email->template('confirmation','default');
						$email->emailFormat('html');
						if ($this->testmode == true) {
//							debug('Test Mode');
							$email->to(array('g8hyp@peers.org.uk'=>'Fred Bloggs'));
						} else {
//							debug('Live Mode');
							$email->to(array($confirmation['Person']['email'] => $confirmation['Person']['full_name']));
						}
						$email->subject('Lighthouse Great Missenden - Helper Acceptance');
						$email->viewVars(array('helpername' => $confirmation['Person']['Nickname'],
										'lhyear' => $lhyear,
										'application_id' => $confirmation['Application']['Application_ID'],
										'roles'=>$confirmationdetails));
						if ($email->send()) { // send email and if successfull
							$this->log(__('Confirmation email sent to %s (%s)',$confirmation['Person']['full_name'],$confirmation['Person']['email']),'email');
							//update the application record to show confirmation has been sent
							$this->Application->id = $confirmation['Application']['Application_ID'];
							$this->Application->set(array('Confirmation_email_sent' => -1,
															'Confirmation_email_date' => date('Y-m-d')));
							$this->Application->save();							
							$results['sent'] += 1; //increment the number of sent emails
						} else { //send failed
							$this->log(__('Confirmation email failed to %s (%s)',$confirmation['Person']['full_name'],$confirmation['Person']['email']),'email');
//							debug('Send failed');
							$results['failed'] += 1; //increment the number of failed emails
						} 
					} else { //helper has no valid email address
//						debug('invalid email');
						$results['invalidemail'] += 1; //increment the number of invalid email addresses
					}
				}
			}
			//built the text for the flash message
			$flashmessage = 'Confirmation emails sent: '.$results['sent'];
			if ($results['failed']>0) {
				$flashmessage = $flashmessage.'  -  Send failed: '.$results['failed'];
			}
			if ($results['invalidemail']>0) {
				$flashmessage = $flashmessage.'  -  Invalid email addresses: '.$results['invalidemail'];
			}
			$this->Session->setFlash($flashmessage); //set flashmessage
			$this->log(__('%s',$flashmessage),'email');
			$this->redirect(array('controller' => 'applications', 'action' => 'index')); //go to summary page
		} else { //request was a get so display a list of confirmations to send
			$this->set('data', $confirmations); 
		}
	}

	
	public function sendreminder() {
		//send reminder emails to last years helpers that haven't registered yet for this year
		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		$sendreminders = array(); //initialise array to hold data for reminder emails
		$results = array('sent'=>0, 'failed'=>0, 'invalidemail'=>0); //initialise array to count send stats
		//setup contain and filter for 
		$this->Person->contain(array('Application' => array('conditions'=>array('Application.Year >= '=> $lhyear - 1),
																'fields'=>array('Application.Application_ID','Application.Year'),
																'order'=>array('Application.Year DESC')
																)));
		$helpers = $this->Person->find('all', array('fields' => array('Person.Nickname', 'Person.email', 'Person.full_name')
//													,'limit' => 10 //comment out limit on live system
//													,'conditions' => array('Person.Person_ID > ' => 10261)
													));
//		debug('Total helpers: '.count($helpers));
		foreach ($helpers as $helper) : // iterate through all helpers to find ones with only one application, maybe this year or last year
			if (count($helper['Application']) > 0 ) {
				$helperswithapplications[] = $helper; //add an good application to confirmations array
			}
		endforeach;
		foreach ($helperswithapplications as $helperwithapplications) :
			if ($helperwithapplications['Application'][0]['Year'] != $lhyear) {
				$sendreminders[] = $helperwithapplications;
			}
		endforeach;
//		debug('Total helpers with applications this year or last year: '.count($helperswithapplications));	
//		debug($helperswithapplications);
//		debug('Total helpers with applications last year only: '.count($sendreminders));
//		debug($sendreminders);
		
		if ($this->request->is('post') || $this->request->is('put')) {
			//send emails if the confirm button has been pressed
//			debug('received post');
			if (count($sendreminders)>0) { //check to see there are some confirmations to send
				foreach ($sendreminders as $sendreminder) :
					//check that the helper has a valid email address
					if(Validation::email($sendreminder['Person']['email'])) {
						//if email is valid start to send the email
//						debug('Valid email');
//						debug($this->emailhandler);
						$email = new CakeEmail($this->emailhandler); //set the email method
						$email->template('reminder','default');
						$email->emailFormat('html');
						if ($this->testmode == true) {
//							debug('Test Mode');
							$email->to(array('g8hyp@peers.org.uk'=>'Fred Bloggs'));
						} else {
//							debug('Live Mode');
							$email->to(array($sendreminder['Person']['email'] => $sendreminder['Person']['full_name']));
						}
						$email->subject('Lighthouse Great Missenden - Helper Invitation for '.$sendreminder['Person']['full_name']);
						$email->viewVars(array('helpername' => $sendreminder['Person']['Nickname'],
											'badgenumber' => $sendreminder['Person']['Person_ID'],
											'lhyear' => $lhyear));
						if ($email->send()) {
							$this->log(__('Reminder email sent to %s (%s)',$sendreminder['Person']['full_name'],$sendreminder['Person']['email']),'email');
							// send email and if successfull
							$results['sent'] += 1; //increment the number of sent emails
//							debug($results['sent']);
						} else { //send failed
							$this->log(__('Reminder email failed (system) to %s (%s)',$sendreminder['Person']['full_name'],$sendreminder['Person']['email']),'email');
//							debug('Send failed');
							$results['failed'] += 1; //increment the number of failed emails
//							debug($results['failed']);
						}
					} else { //helper has no valid email address
						$this->log(__('Reminder email failed (invalid email address) to %s (%s)',$sendreminder['Person']['full_name'],$sendreminder['Person']['email']),'email');
//						debug('invalid email');
						$results['invalidemail'] += 1; //increment the number of invalid email addresses
//						debug($results['invalidemail']);
					}
				endforeach;
			}
			//built the text for the flash message
			$flashmessage = 'Reminder emails sent: '.$results['sent'];
			if ($results['failed']>0) {
				$flashmessage = $flashmessage.'  -  Send failed: '.$results['failed'];
			}
			if ($results['invalidemail']>0) {
				$flashmessage = $flashmessage.'  -  Invalid email addresses: '.$results['invalidemail'];
			}
			$this->Session->setFlash($flashmessage); //set flashmessage
			$this->log(__('%s',$flashmessage),'email');
			$this->redirect(array('controller' => 'applications', 'action' => 'index')); //go to summary page
		} else { //request was a get so display a list of confirmations to send
			$this->set('data', count($sendreminders));
		}
 	}
	

}