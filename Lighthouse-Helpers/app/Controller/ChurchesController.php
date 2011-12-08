<?php
class ChurchesController extends AppController {
    public $helpers = array ('Html','Form');
    public $name = 'Churches';

    function index() {
        $this->set('churches', $this->Church->find('all'));
    }

    public function view($id = null) {
        $this->Church->id = $id;
        $this->set('church', $this->Church->read());
    }

}
?>

