<?php
class AssignedRole extends AppModel {
	public $name = 'AssignedRole';
	public $useTable = 'role_assigned';
	public $primaryKey = 'Role_Assigned_ID';

	public $belongsTo = array(
			'Role' => array(
				'className' => 'Role',
				'foreignKey' => 'tblRole_Role_ID'),
			'Application' => array(
				'className' => 'Application',
				'foreignKey' => 'tblApplication_Application_ID'));

	public $hasMany = array(
				'AssignedSession' => array(
					'className' => 'AssignedSession',
					'foreignKey' => 'tblRole_Assigned_Role_Assigned_ID'));
	

}
