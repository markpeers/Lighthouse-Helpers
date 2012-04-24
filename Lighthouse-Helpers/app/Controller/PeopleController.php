<?php
class PeopleController extends AppController {
    public $name = 'People';

    public function isAuthorized($user) {
    	// All registered users access these actions
    	//if (in_array($this->action, array('index'))) {
    	//	return true;
    	//}
    
    	// Permitted actions depend on user role
    	if (isset($user['role']) && in_array($user['role'], array('reg_user'))) {
    		//if (in_array($this->action, array('printhelperlist'))) {
    		return true;
    		//}
    	}
    	// If no matches here used authorization from appcontroller
    	// i.e. admin gets everything
    	return parent::isAuthorized($user);
    }
    
    
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Person.Last_Name' => 'asc',
			'Person.First_Name' => 'asc'
        	),
		'fields' => array(
			'Person.Person_ID',
			'Person.Title',
			'Person.First_Name',
			'Person.Last_Name'
			)
		);

    function index() {
		$this->set('people', $this->paginate());
    }
    
    public function edit($id = null) {
    	
    	$this->Person->id = $id;
    	if (!$this->Person->exists()) {
    		throw new NotFoundException(__('Invalid person'));
    	}
    	if ($this->request->is('post') || $this->request->is('put')) {
    		if ($this->Person->save($this->request->data)) {
    			$this->Session->setFlash(__('The helper details have been updated'));
				$this->redirect(array('controller' => 'applications',
											'action' => 'helper',
										$this->Session->read('Current.Application'),
										$this->Session->read('Current.Person'),
										$this->Session->read('Filter.Year')));
    		} else {
    			$this->Session->setFlash(__('The role could not be saved. Please, try again.'));
    		}
    	} else {
    		$this->request->data = $this->Person->read(null, $id);
    	}
//    	$assigneds = $this->Role->Assigned->find('list');
//    	$leaderLinks = $this->Role->LeaderLink->find('list');
//    	$offereds = $this->Role->Offered->find('list');
//    	$offeredImports = $this->Role->OfferedImport->find('list');
    	$this->set(compact('assigneds', 'leaderLinks', 'offereds', 'offeredImports'));
    	 
    }

    public function view($id = null) {
        $this->Person->id = $id;
        $this->set('person', $this->Person->read());
    }
    
    public function search() {
    	
    	$sessiondata = $this->getsessiondata();
    	$lhyear = $sessiondata['lhyear'];
    	 
		if ( $this->request->is('ajax') ) {
            Configure::write ( 'debug', 0 );
            $this->autoRender=false;
            $this->Person->contain(array('Application',
            							'Application.Application_id',
            							'Application.Year'));
            $lhhelpers=$this->Person->find('all',array('conditions'=>array(
            		'Person.Deleted'=>'0',
            		'OR' => array(
		            array('Person.Last_Name LIKE'=>'%'.$_GET['term'].'%'),
		            array('Person.Nickname LIKE'=>'%'.$_GET['term'].'%'),
            		array('Person.First_Name LIKE'=>'%'.$_GET['term'].'%'),
            		array('Person.Person_ID LIKE'=>'%'.$_GET['term'].'%')
		            )),
            		'order'=>array('Person.Last_Name', 'Person.Nickname')
            ));
            $i=0;
                foreach($lhhelpers as $user){
//                	if (strlen($user['Person']['Nickname'])=0) {
//                		$response[$i]['value']=$user['Person']['First_Name'].' '.$user['Person']['Last_Name'];
//                	}else {
                    	$response[$i]['value']=$user['Person']['Nickname'].' '.$user['Person']['Last_Name'];
//                	}
                    $response[$i]['id']=$user['Person']['Person_ID'];
                $i++;
                }
            echo json_encode($response);
    	
    	} elseif ($this->request->is('post')) {
//    		debug($this->request->data);
     		$this->Person->contain(array('Application',
    		            				'Application.application_id',
    		            				'Application.year = '.$lhyear));
    		$lhhelper=$this->Person->find('first',array('conditions'=>array('Person_ID'=>$this->request->data['Person']['id']),
											    		'fields'=>array('Person.Person_ID', 'Person.First_Name', 'Person.NickName', 'Person.Last_Name')
											    		));
//    		debug($lhhelper);
   		
    		if(count($lhhelper['Application']) == 0){
//    			debug($lhhelper);
    			$this->Session->setFlash('No application from '.$lhhelper['Person']['First_Name'].' '.$lhhelper['Person']['Last_Name'].' for '.$lhyear);
    			$this->redirect($this->referer());
    		}else{
    			$application = $lhhelper['Application']['0']['application_id'];
    			$this->redirect(array('controller'=>'applications', 
    								'action'=>'helper', 
    								$application, 
    								$this->request->data['Person']['id'],
    								$lhyear 
    								));  	
    		}
    	}
    }
}