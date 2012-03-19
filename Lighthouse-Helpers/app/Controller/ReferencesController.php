<?php
App::uses('AppController', 'Controller');
/**
 * References Controller
 *
 * @property Reference $Reference
 */
class ReferencesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Reference->recursive = 0;
		$this->set('references', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Reference->id = $id;
		if (!$this->Reference->exists()) {
			throw new NotFoundException(__('Invalid reference'));
		}
		$this->set('reference', $this->Reference->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Reference->create();
			if ($this->Reference->save($this->request->data)) {
				$this->Session->setFlash(__('The reference has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reference could not be saved. Please, try again.'));
			}
		}
		$referees = $this->Reference->Referee->find('list');
		$people = $this->Reference->Person->find('list');
		$this->set(compact('referees', 'people'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Reference->id = $id;
		
		if (!$this->Reference->exists()) {
			throw new NotFoundException(__('Invalid reference'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//debug($this->request);
			if ($this->Reference->save($this->request->data)) {
				$this->Session->setFlash(__('The reference has been updated'));
				$this->redirect(array('controller' => 'applications', 
										'action' => 'helper',
										$this->Session->read('Current.Application'),
										$this->Session->read('Current.Person'),
										$this->Session->read('Filter.Year')));
			} else {
				$this->Session->setFlash(__('The reference could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Reference->read(null, $id);
		}
		//debug($this->request);
		$helper = $this->request->data['Person']['full_name'];
		$referees = $this->Reference->Referee->find('list', array('order' => array('Referee.Last_Name')));
		$people = $this->Reference->Person->find('list', array('order' => array('Person.Last_Name')));
		$this->set(compact('referees', 'people', 'helper'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Reference->id = $id;
		if (!$this->Reference->exists()) {
			throw new NotFoundException(__('Invalid reference'));
		}
		if ($this->Reference->delete()) {
			$this->Session->setFlash(__('Reference deleted'));
			$this->redirect(array('controller' => 'applications', 
									'action' => 'helper',
									$this->Session->read('Current.Application'),
									$this->Session->read('Current.Person'),
									$this->Session->read('Filter.Year')));
					}
		$this->Session->setFlash(__('Reference was not deleted'));
		$this->redirect(array('controller' => 'applications', 
								'action' => 'helper',
								$this->Session->read('Current.Application'),
								$this->Session->read('Current.Person'),
								$this->Session->read('Filter.Year')));
	}
	
/**
 * copy method
 * 
 * copy the reference with id $id into a new record with year = current year
 * 
 * @param string $id, string $year
 * @return void
 */
	public function copy($id = null, $year = null) {
		$this->Reference->read(null, $id);
		$this->Reference->set(array('Reference_ID' => null, 'Year' => $year));
//			$this->Reference->create();
		if ($this->Reference->save()) {
//			debug('New reference saved');
//			debug($this->Reference->id);
			$this->Session->setFlash(__('The reference has been copied'));
			$this->redirect(array('controller' => 'applications',
												'action' => 'helper',
												$this->Session->read('Current.Application'),
												$this->Session->read('Current.Person'),
												$this->Session->read('Filter.Year')));
				
		}
//				$this->Session->setFlash(__('The reference has been saved'));
//				$this->redirect(array('action' => 'index'));
	}

/**
* referencerequest method
*
* generate reference request forms to post to referees
*
* @param void
* @return void
*/
	public function referencerequest() {
		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		$references = $this->Reference->find('all', array(
													'fields' => array('Reference.tblPerson_Person_ID', 
																		'Reference.tblReferee_Referee_ID', 
																		'Reference.Reference_Status', 
																		'Reference.Year',
																		'Referee.Title',
																		'Referee.First_Name',
																		'Referee.Last_Name',
																		'Referee.Address_1',
																		'Referee.Address_2',
																		'Referee.Town',
																		'Referee.County',
																		'Referee.Post_Code',
																		'Person.Person_ID',
																		'Person.Last_Name',
																		'Person.Title',
																		'Person.First_Name',
																		'Person.Nickname')
//													,'limit' => 10 //comment out limit on live system
													,'conditions' => array('Reference.Year' => $lhyear
																			,'Reference.Reference_Status' => 2
																			)
													,'order' => array('Reference.tblReferee_Referee_ID')
													));
//		debug('Total references: '.count($references));
		$this->Session->setFlash(__('There are %s reference requests forms to print', count($references)));
		$this->set('data',$references);
	}

/**
* printsuccess method
*
* when the user has printed the reference request, this method updates
* the reference records and sets the requested date to now and status to 
* awaiting reply
*
* @param void
* @return void
*/
	public function printsuccess() {
		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		//update all reference for current year with status 2 (send request) to status 3 (awaiting repy)
		//and set requested date to now
		if ($this->Reference->updateAll(array('Reference.Reference_Status' => 3,
											'Reference.Reference_Requested_Date' => __('"%s"',date('Y-m-d')),
											'Reference.Reference_Received_Date' => null,
											'Reference.Reference_OK' => null),
										array('Reference.Reference_Status' => 2,
											'Reference.Year' => $lhyear))) {
			$this->Session->setFlash(__('The references have been updated'));
		} else {
			$this->Session->setFlash(__('The references could not be updated, please try again'));
		}
		$this->redirect(array('controller' => 'applications', 'action' => 'index'));
	}
}