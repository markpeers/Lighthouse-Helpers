<?php
class Role extends AppModel {
	public $useTable = 'role';
	public $primaryKey = 'Role_ID';
	public $displayField = 'RoleName';

	public $hasMany = array(
			'AssignedRole' => array(
				'className' => 'AssignedRole',
				'foreignKey' => 'tblRole_Role_ID'),
			'OfferedRole' => array(
				'className' => 'OfferedRole',
				'foreignKey' => 'tblRole_Role_ID'));

}
