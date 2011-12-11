<?php
class OfferedRole extends AppModel {
	public $name = 'OfferedRole';
	public $useTable = 'role_offered';
	public $primaryKey = 'Role_Offered_ID';

	public $belongsTo = array(
			'Role' => array(
				'className' => 'Role',
				'foreignKey' => 'tblRole_Role_ID'),
			'Application' => array(
				'className' => 'Application',
				'foreignKey' => 'tblApplication_Application_ID'));

	
	public $hasMany = array(
			'OfferedSession' => array(
						'className' => 'OfferedSession',
						'foreignKey' => 'tblRole_Offered_Role_Offered_ID'));
		
		
}
