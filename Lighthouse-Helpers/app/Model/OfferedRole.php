<?php
class OfferedRole extends AppModel {
	public $useTable = 'role_offered';
	public $primaryKey = 'Role_Offered_ID';

	public $belongsTo = array(
			'Role' => array(
				'className' => 'Role',
				'foreignKey' => 'tblRole_Role_ID'),
			'Application' => array(
				'className' => 'Application',
				'foreignKey' => 'tblApplication_Application_ID'));

}
