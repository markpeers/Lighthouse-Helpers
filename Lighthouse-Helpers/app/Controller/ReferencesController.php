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
}
