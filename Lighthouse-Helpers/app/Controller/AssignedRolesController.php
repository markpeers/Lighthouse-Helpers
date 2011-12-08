<?php
class AssignedRolesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		debug('Assigned Roles');
		$this->AssignedRole->recursive = 0;
		$this->set('assignedrole', $this->paginate());
	}

}