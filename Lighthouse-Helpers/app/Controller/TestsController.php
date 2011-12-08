<?php
class TestsController extends AppController {
	public $helpers = array('Js');
	public $components = array('RequestHandler');
    public  $uses =  null;

    function index(){
		$this->log('TestController Index', 'debug');
		if ($this->RequestHandler->isAjax()){
				$this->log('Ajax request', 'debug');
				$this->log($this->request, 'debug');
				$this->set('data', $this->request->data);
				$this->render('page', 'ajax');
			}
		else {	
				$this->log('Normal request', 'debug');
    			$this->layout='testdefault';
			}
    	}
	public function page(){
		if ($this->RequestHandler->isAjax()){
			$this->render('page', 'ajax');
			}
		}
 }
?>
