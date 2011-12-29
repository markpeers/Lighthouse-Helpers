<?php
class PeopleController extends AppController {
    public $name = 'People';

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
            		array('Person.First_Name LIKE'=>'%'.$_GET['term'].'%')
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
    		debug($this->request->data);
     		$this->Person->contain(array('Application',
    		            				'Application.application_id',
    		            				'Application.year = '.$lhyear));
    		$lhhelper=$this->Person->find('first',array('conditions'=>array('Person_ID'=>$this->request->data['Person']['id']),
											    		'fields'=>array('Person.Person_ID', 'Person.First_Name', 'Person.NickName', 'Person.Last_Name')
											    		));
    		debug($lhhelper);
   		
    		if(count($lhhelper['Application']) == 0){
    			debug($lhhelper);
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