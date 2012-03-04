<?php
class OfferedRolesController extends AppController {
	
/**
* accept method
*
* @param string $id, $application_id
* @return void
*/
	public function accept($id = null, $application_id = null) {
		$this->OfferedRole->id = $id;
	
		if (!$this->OfferedRole->exists()) {
			throw new NotFoundException(__('Invalid role'));
		}
		//debug($this->request);
		$offeredrole = $this->OfferedRole->read(null, $id);
		//debug($offeredrole);
		$roletoadd = array('AssignedRole' => array('tblRole_Role_ID' => $offeredrole['OfferedRole']['tblRole_Role_ID'],
													'tblApplication_Application_ID' => $offeredrole['OfferedRole']['tblApplication_Application_ID']));
		//debug($roletoadd);
		if ($this->OfferedRole->Application->AssignedRole->save($roletoadd)) {
			$this->Session->setFlash(__('The %s role has been assigned', $offeredrole['Role']['RoleName']));
			//debug($this->OfferedRole->Application->AssignedRole->id);
			foreach ($offeredrole['OfferedSession'] as $offersession) {
				$this->OfferedRole->Application->AssignedRole->AssignedSession->create();
				$sessiontoadd = array('AssignedSession' => array('tblRole_Assigned_Role_Assigned_ID' => $this->OfferedRole->Application->AssignedRole->id,
																'tblSessions_Sessions_ID' => $offersession['tblSessions_Sessions_ID']));
				//debug($sessiontoadd);
				$this->OfferedRole->Application->AssignedRole->AssignedSession->save($sessiontoadd);
			}
			$this->redirect(array('controller' => 'applications',
											'action' => 'helper',
			$this->Session->read('Current.Application'),
			$this->Session->read('Current.Person'),
			$this->Session->read('Filter.Year')));
		} else {
			$this->Session->setFlash(__('The role could not be assigned. Please, try again.'));
		}
	}
}