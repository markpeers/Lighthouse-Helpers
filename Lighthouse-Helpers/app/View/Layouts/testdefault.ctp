<html>
    <head>
	<?php
		echo $this->Html->script('jquery-1.7.min'); // Include jQuery library
		echo $this->Html->script('jquery-ui-1.8.16.custom.min'); // Include jQuery-UI library
		echo $this->Html->css('ui-lightness/jquery-ui-1.8.16.custom');
	?>
	<script type="text/javascript">
        $(document).ready(function () {
            //    alert('JQuery is succesfully included');

			// When the user finishes typing 
			// a character in the text box...
			$('#txtValue').keyup(function(){
				
				// Call the function to handle the AJAX.
				// Pass the value of the text box to the function.
				sendValue($(this).val());   
				
			}); 

    		$("input#autocomplete").autocomplete({
    			source: ["c++", "java", "php", "coldfusion", "javascript", "asp", "ruby"]
			});

        });

	</script>

    </head>
    <body>
    <?php
        echo $content_for_layout;
    ?>
	<?php
		echo $this->Js->writeBuffer();
	?>
    </body>
</html>

