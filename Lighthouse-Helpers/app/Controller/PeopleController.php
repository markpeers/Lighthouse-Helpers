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

}
?>

