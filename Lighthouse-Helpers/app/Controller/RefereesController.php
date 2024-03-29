<?php
App::uses('AppController', 'Controller');
/**
 * Referees Controller
 *
 * @property Referee $Referee
 */
class RefereesController extends AppController {
	public $uses = array('Referee',
							'RefereeTemp', 
							'Reference',
							'Person');
	public $name = 'Referees';
	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Referee->recursive = 0;
		$this->set('referees', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Referee->id = $id;
		if (!$this->Referee->exists()) {
			throw new NotFoundException(__('Invalid referee'));
		}
		$this->set('referee', $this->Referee->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Referee->create();
			if ($this->Referee->save($this->request->data)) {
				$this->Session->setFlash(__('The referee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The referee could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Referee->id = $id;
		if (!$this->Referee->exists()) {
			throw new NotFoundException(__('Invalid referee'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Referee->save($this->request->data)) {
				$this->Session->setFlash(__('The referee has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The referee could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Referee->read(null, $id);
		}
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
		$this->Referee->id = $id;
		if (!$this->Referee->exists()) {
			throw new NotFoundException(__('Invalid referee'));
		}
		if ($this->Referee->delete()) {
			$this->Session->setFlash(__('Referee deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Referee was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	
	/**
	* confirm method
	*
	* @param string $id
	* @return void
	*/
	public function confirm($id = null) {
		$this->RefereeTemp->id = $id;
		if (!$this->RefereeTemp->exists()) {
			throw new NotFoundException(__('Invalid reference'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//debug($this->request);
			if ($this->request->data['Reference']['referee'] > 0) {
				//user has selected referee from dropdown
				//debug('Use known referee');
				$referee_id = $this->request->data['Reference']['referee'];
				$flashmessage = 'Known referee used and ';
			} else { //no known referee selected for use the offered referee
				//debug('Use offered referee');
				//copy refereetemp record to referee table
				$refereetemp = $this->RefereeTemp->read(null, $id);
				$refereetoadd = array('Title'=>$refereetemp['RefereeTemp']['Title'],
									'First_Name'=>$refereetemp['RefereeTemp']['First_Name'],
									'Last_Name'=>$refereetemp['RefereeTemp']['Last_Name'],
									'Address_1'=>$refereetemp['RefereeTemp']['Address_1'],
									'Address_2'=>$refereetemp['RefereeTemp']['Address_2'],
									'Town'=>$refereetemp['RefereeTemp']['Town'],
									'County'=>$refereetemp['RefereeTemp']['County'],
									'Post_Code'=>$refereetemp['RefereeTemp']['Post_Code'],
									'Telephone'=>$refereetemp['RefereeTemp']['Telephone']
									);
				//debug($refereetoadd);
				if ($this->Referee->save($refereetoadd)) {
					$referee_id = $this->Referee->id;
					$flashmessage = 'New referee added to the know referee list and ';
				} else {
					$referee_id = 0;
					$flashmessage = 'The referee could not be added. Please, try again. ';
				}
			}
			if ($referee_id > 0) {
				//if there is now a referee to use then add a new reference record
				$referencetoadd = array('tblPerson_Person_ID'=>$this->Session->read('Current.Person'),
										'tblReferee_Referee_ID'=>$referee_id,
										'Year'=>$this->Session->read('Filter.Year')
										);
				//debug($referencetoadd);
				if ($this->Reference->save($referencetoadd)) {
					$flashmessage = $flashmessage.'reference added.';
					//debug($flashmessage);
				} else {
					$flashmessage = $flashmessage.'The reference could not be added. Please, try again. ';
					//debug($flashmessage);
				}
			} else {
				$flashmessage = $flashmessage.'The reference could not be added. Please, try again. ';
				//debug($flashmessage);
			}
			$this->Session->setFlash($flashmessage);
			//redirect to helper page
			$this->redirect(array('controller' => 'applications',
									'action' => 'helper',
									$this->Session->read('Current.Application'),
									$this->Session->read('Current.Person'),
									$this->Session->read('Filter.Year')
									)
							);
		}
		
		$refereetemp = $this->RefereeTemp->read(null, $id);
		$referees = $this->Referee->find('list', array('order' => array('Referee.Last_Name'),
														'conditions' => array('Referee.Last_Name LIKE' => $refereetemp['RefereeTemp']['Last_Name'])
														)
										);
		//debug($referees);
		$this->set(compact('refereetemp', 'referees'));
	}
		
}
