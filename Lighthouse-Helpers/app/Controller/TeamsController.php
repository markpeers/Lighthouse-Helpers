<?php

class TeamsController extends AppController {
	public $components = array('Age');
	public $uses = array('Application',
						'Role', 
						'AssignedRole', 
						'Person'
	);
	public $name = 'Teams';

	public function isAuthorized($user) {
		//$this->log($this->request['pass'][0],'debug');
		// Permitted actions depend on user role
		if (isset($user['role']) && array_key_exists($user['role'], Configure::read('user_roles'))) {
			return true;
		}
		
		// If no matches here used authorization from appcontroller
		// i.e. admin gets everything
		return parent::isAuthorized($user);
	}
	

	/**
	* view method
	*
	*
	* @param $group - a string name of grouping on helper summary page
	* @return void
	*/
	public function view($group = null) {
		$sessiondata = $this->getsessiondata();
		$lhyear = $sessiondata['lhyear'];
		$lhyears = $sessiondata['lhyears'];
		//$applicationProblem = $sessiondata['applicationProblem'];
		
		
		//check to see if the filter is being changed
		if (!empty($this->request->data)) {
			//debug($this->request->data);
			$lhyear = $this->request->data['Filter']['Year'];
			//write the updated filter year to the session
			$this->Session->write('Filter.Year', $lhyear);
			//$applicationProblem = $this->request->data['Filter']['ApplicationProblem'];
			//$this->Session->write('Filter.Problem', $applicationProblem);
		}
		//referece date for age calculations
		$refdate = new DateTime($lhyear.'-'.Configure::read('ageAtDate'));
		
		//build the rolegroups array
		$rolegroups = array('Role' => array(),
								'Toddler' => array('AGL' => 62, 'Teacher' => 63, 'Lighthouse Keepers' => 21, 'Special Needs' => 69), 
								'4s' => array('AGL' => 46, 'Teacher' => 54, 'Lighthouse Keepers' => 6, 'Lamplighters' => 14, 'Special Needs' => 70), 
								'5s' => array('AGL' => 47, 'Teacher' => 55, 'Lighthouse Keepers' => 7, 'Lamplighters' => 15, 'Special Needs' => 71), 
								'6s' => array('AGL' => 48, 'Teacher' => 56, 'Lighthouse Keepers' => 8, 'Lamplighters' => 16, 'Special Needs' => 72), 
								'7s' => array('AGL' => 49, 'Teacher' => 57, 'Lighthouse Keepers' => 9, 'Lamplighters' => 17, 'Special Needs' => 73), 
								'8s' => array('AGL' => 50, 'Teacher' => 58, 'Lighthouse Keepers' => 10, 'Lamplighters' => 18, 'Special Needs' => 74), 
								'9s' => array('AGL' => 51, 'Teacher' => 59, 'Lighthouse Keepers' => 12, 'Lamplighters' => 19, 'Special Needs' => 75), 
								'10+' => array('AGL' => 52, 'Teacher' => 60, 'Lighthouse Keepers' => 13, 'Special Needs' => 76), 
								'12s' => array('AGL' => 53, 'Teacher' => 61, 'Lighthouse Keepers' => 78, 'Special Needs' => 77),
								'Lighthouse Keepers' => array('Toddler' => 21, '4s' => 6, '5s' => 7, '6s' => 8, '7s' => 9, '8s' => 10, '9s' => 12, '10+' => 13, '12s' => 78),
								'Lamp Lighters' => array('4s' => 14, '5s' => 15, '6s' => 16, '7s' => 17, '8s' => 18, '9s' => 19),
								'Agegroup Leaders' => array('Toddler' => 62, '4s' => 46, '5s' => 47, '6s' => 48, '7s' => 49, '8s' => 50, '9s' => 51, '10+' => 52, '12s' => 53),
								'Teachers' => array('Toddler' => 63, '4s' => 54, '5s' => 55, '6s' => 56, '7s' => 57, '8s' => 58, '9s' => 59, '10+' => 60, '12s' => 61),
								'Special Needs' => array('Toddler' => 69, '4s' => 70, '5s' => 71, '6s' => 72, '7s' => 73, '8s' => 74, '9s' => 75, '10+' => 76, '12s' => 77),
								'Administration' => array('Leader' => 82, 'Helper' => 2),
								'Car Park' => array('Leader' => 83, 'Helper' => 27),
								'Chairman' => array('Chairman' => 64, 'Vice-chair' => 108, 'Treasurer' => 102),
								'Comforts Tent' => array('Leader' => 84, 'Helper' => 34),
								'Craft - 4\'s' => array('Leader' => 104, 'Helper' => 22),
								'Craft - 5\'s to 9\'s' => array('Leader' => 105, 'Helper' => 23),
								'Craft - 10+s' => array('Leader' => 106, 'Helper' => 24),
								'Craft Preparation' => array('Helper' => 1),
								'Drama' => array('Leader' => 86, 'Helper' => 81),
								'Evening Events - General' => array('Leader' => 87, 'General' => 37, 'BBQ' => 38, 'Teenage Activities' => 40, 'Tuck Shop' => 39),
								'Evening Events - BBQ' => array('Leader' => 87, 'General' => 37, 'BBQ' => 38, 'Teenage Activities' => 40, 'Tuck Shop' => 39),
								'Evening Events - Teenage Activities' => array('Leader' => 87, 'General' => 37, 'BBQ' => 38, 'Teenage Activities' => 40, 'Tuck Shop' => 39),
								'Evening Events - Tuck Shop' => array('Leader' => 87, 'General' => 37, 'BBQ' => 38, 'Teenage Activities' => 40, 'Tuck Shop' => 39),
								'First Aid' => array('Leader' => 88, 'Helper' => 31),
								'Helper\'s Children' => array('Leader' => 89, 'Helper' => 30),
								'Lifeboat Tent' => array('Leader' => 90, 'Helper' => 35),
								'Lighthouse Cafe' => array('Leader' => 91, 'Helper' => 32),
								'Main Stage' => array('Leader' => 92, 'Helper' => 65),
								'Music' => array('Leader' => 93, 'Helper' => 28),
								'Pastoral Care' => array('Helper' => 67),
								'Photographer' => array('Helper' => 68),
								'Quiet Tent' => array('Leader' => 94, 'Helper' => 29),
								'Registrations' => array('Leader' => 95, 'Helper' => 36),
								'Sales' => array('Leader' => 96, 'Helper' => 41),
								'Saturday Evening Event' => array('Leader' => 97, 'Helper' => 42),
								'Security' => array('Leader' => 98, 'Helper' => 4),
								'Setting Up Site' => array('Manager' => 99, 'Setup' => 5, 'Helper' => 26, 'Breakdown' => 43),
								'Site' => array('Manager' => 99, 'Setup' => 5, 'Helper' => 26, 'Breakdown' => 43),
								'Site Breakdown' => array('Manager' => 99, 'Setup' => 5, 'Helper' => 26, 'Breakdown' => 43),
								'Site Manager' => array('Manager' => 99, 'Setup' => 5, 'Helper' => 26, 'Breakdown' => 43),
								'Sports' => array('Leader' => 100, 'Helper' => 25),
								'Tech Support' => array('Helper' => 66),
								'Toy Sale' => array('Helper' => 80),
								'Treasurer' => array('Chairman' => 64, 'Vice-chair' => 108, 'Treasurer' => 102),
								'Vice Chair' => array('Chairman' => 64, 'Vice-chair' => 108, 'Treasurer' => 102),
								'Water Tent' => array('Leader' => 101, 'Helper' => 33)
		);
		//walk through all the roles in the selected role group
		foreach ($rolegroups[$group] as $key => $value) {
			//debug(__('Key %s, Value %s',$key,$value));
			//find all applications this year that are for role $value
			$this->AssignedRole->contain(array('Application' => array('fields' => array('Application.Year',
																							'Application.tblPerson_Person_ID')),
			));
	
			$temproles = ($this->AssignedRole->find('all', array('fields' => array('tblRole_Role_ID','tblApplication_Application_ID'),
																		'conditions' => array('AssignedRole.tblRole_Role_ID' => $value,
																								'Application.Year' => $this->Session->read('Filter.Year')),
			)));
			//debug($temproles);
			//walk through all the applications found and put person id into an array $personids
			$personids = array();
			foreach ($temproles as $temprole) {
				$personids[] = $temprole['Application']['tblPerson_Person_ID'];
			}
			//debug($personids);
			//use the array of person ids to find all helpers for the role
			//and sort them for display
			$data[$key] = $this->Person->find('all', array('contain'=>array('Application' => array('fields' => array('Application.Year',
																													'Application.tblPerson_Person_ID',
																													'Application.Application_ID'),
																									'conditions' => array('Application.Year' => $this->Session->read('Filter.Year')))),
															'fields' => array('Person.Title',
																				'Person.Last_Name',
																				'Person.First_Name',
																				'Person.Nickname',
																				'Person.Telephone_1',
																				'Person.Telephone_2',
																				'Person.Date_of_birth',
																				'Person.email'),
															//'recursive' => 0,
															'conditions' => array('Person.Person_ID' => $personids),
															'order' => array('Person.Last_Name',
																				'Person.First_Name')));
			for ($i = 0; $i < count($data[$key]); $i++) {
				//calculate age and add to person array
	 			$refdate = new DateTime($lhyear.'-'.Configure::read('ageAtDate'));
				$dummydob = new DateTime('1900-01-01'); //dummy dob in case one isn't present'
				if (isset($data[$key][$i]['Person']['Date_of_birth'])) {
					$dob = new DateTime($data[$key][$i]['Person']['Date_of_birth']);
				} else {
					$dob = $dummydob;
				}
				$data[$key][$i]['Person']['LHAge'] = $this->Age->getage($dob, $refdate);
				//debug($person);
			}
			//debug($data[$key]);	
		}
		//build a "filtered application" array ready to add previous and next application
		//this is to make it the same as its done in the applications controller
		$j = 0;
		$filtered_applications = array();
		foreach ($data as $role => $helpergroup) :
			//debug($role);
			//debug($helpergroup);
			for ($i = 0; $i < count($helpergroup); $i++) {
				//debug(__('Loading $filtered_applications[%s]', $j + $i));
				$filtered_applications[$j + $i]['Application']['Application_ID'] = $helpergroup[$i]['Application'][0]['Application_ID'];
				$filtered_applications[$j + $i]['Application']['tblPerson_Person_ID'] = $helpergroup[$i]['Application'][0]['tblPerson_Person_ID'];
				$filtered_applications[$j + $i]['Application']['Year'] = $helpergroup[$i]['Application'][0]['Year'];
				$filtered_applications[$j + $i]['Person']['Person_ID'] = $helpergroup[$i]['Person']['Person_ID'];
				$filtered_applications[$j + $i]['Person']['Last_Name'] = $helpergroup[$i]['Person']['Last_Name'];
				$filtered_applications[$j + $i]['Person']['First_Name'] = $helpergroup[$i]['Person']['First_Name'];
				//debug($filtered_applications[$j + $i]);
			}
			$j += count($helpergroup);
		endforeach;
		//for each filtered application returned, find preveious and next and add to the array
		for ($i = 0; $i < count($filtered_applications); $i++) {
			if ($i < count($filtered_applications) - 1) {
				$filtered_applications[$i]['next_application']['application_id'] = $filtered_applications[$i + 1]['Application']['Application_ID'];
				$filtered_applications[$i]['next_application']['person_id'] = $filtered_applications[$i + 1]['Application']['tblPerson_Person_ID'];
				$filtered_applications[$i]['next_application']['year'] = $filtered_applications[$i + 1]['Application']['Year'];
			} else {
				$filtered_applications[$i]['next_application'] = null;
			}
			if ($i > 0) {
				$filtered_applications[$i]['previous_application']['application_id'] = $filtered_applications[$i - 1]['Application']['Application_ID'];
				$filtered_applications[$i]['previous_application']['person_id'] = $filtered_applications[$i - 1]['Application']['tblPerson_Person_ID'];
				$filtered_applications[$i]['previous_application']['year'] = $filtered_applications[$i - 1]['Application']['Year'];
			} else {
				$filtered_applications[$i]['previous_application'] = null;
			}
		}
		
		//debug($filtered_applications);
		$this->Session->write('FilterdApplications', $filtered_applications);
		
		//some role groups need the name changing to make more sense on the page
		switch ($group) {
			case 'Evening Events - General': $group = 'Evenings'; break;
			case 'Evening Events - BBQ': $group = 'Evenings'; break;
			case 'Evening Events - Teenage Activities': $group = 'Evenings'; break;
			case 'Evening Events - Tuck Shop': $group = 'Evenings'; break;
			case 'Setting Up Site': $group = 'Site'; break;
			case 'Site Breakdown': $group = 'Site'; break;
			case 'Site Manager': $group = 'Site'; break;
			case 'Teachers': $group = 'Teaching'; break;
			case 'Chairman': $group = 'Management'; break;
			case 'Vice Chair': $group = 'Management'; break;
			case 'Treasurer': $group = 'Management'; break;
		}
		$this->set('LHYears', $sessiondata['lhyears']);
		//$this->set('problemFilterOptions', $this->problemFilterOptions);
		$this->set('refdate', $refdate);
		$this->set('rolegroup', $group);
		$this->set('helpersbyrole', $data);
	}

}