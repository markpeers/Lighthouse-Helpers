<?php
class AssignedSessionsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		//debug('Assigned Sessions');
		$this->AssignedSession->recursive = 0;
		$this->set('assignedsession', $this->paginate());
	}

	/**
	* add method
	*
	* @return void
	*/
	public function add($assignedRoleID = NULL, $sessionType = NULL) {
		$record = array('AssignedSession' => array('tblRole_Assigned_Role_Assigned_ID'=>$assignedRoleID,
											'tblSessions_Sessions_ID'=>$sessionType));
		$this->AssignedSession->create();
		if ($this->AssignedSession->save($record)) {
			$this->Session->setFlash(__('Session added'));
		} else {
			$this->Session->setFlash(__('The session could not be added. Please, try again.'));
		} 
		$this->redirect($this->referer());
	}
	
	
/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AssignedSession->id = $id;
		if (!$this->AssignedSession->exists()) {
			throw new NotFoundException(__('Invalid session'));
		}
		if ($this->AssignedSession->delete()) {
			$this->Session->setFlash(__('Session deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Session was not deleted'));
		$this->redirect($this->referer());
	}
}
	