<?php
class AssignedRolesController extends AppController {
	//public $uses = array('AssignedRolesController', 'Person');
	//public $name = 'AssignedRoles';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//debug('Assigned Roles');
		$this->AssignedRole->recursive = 0;
		$this->set('assignedrole', $this->paginate());
	}

	/**
	* edit method
	*
	* @param string $id
	* @return void
	*/
	public function edit($id = null) {
		$this->AssignedRole->id = $id;
	
		if (!$this->AssignedRole->exists()) {
			throw new NotFoundException(__('Invalid role'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//debug($this->request);
			if ($this->AssignedRole->save($this->request->data)) {
				$this->Session->setFlash(__('The assigned role has been updated'));
				$this->redirect(array('controller' => 'applications',
											'action' => 'helper',
				$this->Session->read('Current.Application'),
				$this->Session->read('Current.Person'),
				$this->Session->read('Filter.Year')));
			} else {
				$this->Session->setFlash(__('The assigned could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->AssignedRole->read(null, $id);
		}
		//debug($this->request);
		$helper = $this->AssignedRole->Application->Person->find('first', array('fields' => 'full_name',
													'recursive' => 0,
													'conditions' =>	array('Person.Person_ID' => $this->request->data['Application']['tblPerson_Person_ID'] )));
		$roles = $this->AssignedRole->Role->find('list', array('order' => array('Role.RoleName')));
		//$people = $this->Reference->Person->find('list', array('order' => array('Person.Last_Name')));
		$this->set(compact('helper','roles'));
	}
	
/**
 * add method
 *
 * @return void
 */
	public function add($application_id = NULL, $person_id=null) {
		if ($this->request->is('post')) {
			$this->AssignedRole->create();
			if ($this->AssignedRole->save($this->request->data)) {
				$this->Session->setFlash(__('The role has been assigned'));
				$this->redirect(array('controller' => 'applications',
											'action' => 'helper',
				$this->Session->read('Current.Application'),
				$this->Session->read('Current.Person'),
				$this->Session->read('Filter.Year')));
			} else {
				$this->Session->setFlash(__('The role could not be saved. Please, try again.'));
			}
		}
		$helper = $this->AssignedRole->Application->Person->find('first', array('fields' => 'full_name',
													'recursive' => 0,
													'conditions' =>	array('Person.Person_ID' => $person_id )));
		$roles = $this->AssignedRole->Role->find('list', array('order' => array('Role.RoleName')));
		$this->set(compact('helper','roles', 'application_id'));
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
		$this->AssignedRole->id = $id;
		if (!$this->AssignedRole->exists()) {
			throw new NotFoundException(__('Invalid reference'));
		}
		if ($this->AssignedRole->delete()) {
			$this->Session->setFlash(__('Role assignment deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Role assignment was not deleted'));
		$this->redirect($this->referer());
	}
	
	
}