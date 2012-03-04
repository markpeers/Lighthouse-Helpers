    <label for="txtValue">Enter a value : </label>
    <input type="text" name="txtValue" value="" id="autocomplete">
	<?php 

		echo $this->Form->create();
		echo $this->Form->input('username', array('label' => 'Enter a value (cake) : '));    //text    
		//$this->Js->get('#username')->event('keyup', $this->Js->request(array(
		//									'action' => 'index',
		//									'value' => 'bert'), 
		//									array(
		//										'async' => true,
		//										'update' => '#content')));
		//debug($this->request->data);
		//echo $this->Js->link('save', array('url'=>$url), array('update'=>'#content'));
		echo $this->Js->link('test link', array('page' => 2), array(
														'before' => $this->Js->get('#sending')->effect('fadeIn'), 
														'complete' => $this->Js->get('#sending')->effect('fadeOut'), 
														'update' => '#content',
														'data' => 'Fred Bert Harry'));	
		echo $this->Js->Submit('Test', array('update' => '#content'));
		echo $this->Form->end();
	?>
		 
    <div id="content">Display</div>
	<div id="sending" style="display: none;">Sending...</div>

