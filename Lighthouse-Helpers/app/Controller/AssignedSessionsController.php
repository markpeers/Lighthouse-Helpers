<?php
class AssignedSessionsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		debug('Assigned Sessions');
		$this->AssignedSession->recursive = 0;
		$this->set('assignedsession', $this->paginate());
	}

}