<?php
class AssignedSession extends AppModel {
	public $name = 'AssignedSession';
	public $useTable = 'session_assigned';
	public $primaryKey = 'Session_Assigned_ID';

	public $belongsTo = array(
			'Session' => array(
				'className' => 'Session',
				'foreignKey' => 'tblSessions_Sessions_ID'),
			'AssignedRole' => array(
				'className' => 'AssignedRole',
				'foreignKey' => 'tblRole_Assigned_Role_Assigned_ID'));



}
