<?php
class RoleLeaderLink extends AppModel {
	public $useTable = 'role_leader_link';
	public $primaryKey = 'role_id';
	
	public $belongsTo = array(
				'Role' => array(
					'className' => 'Role',
					'foreignKey' => 'role_leader_id'));
	
}
