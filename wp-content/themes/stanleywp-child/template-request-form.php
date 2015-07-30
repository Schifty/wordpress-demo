<?php
/*
Template Name: Request Form

*/
//gets the header
get_header();

//if the form hs been submitted
	if(isset($_POST["Submit"]))
	{
		
		//chek  for errors
		$error=show_request_form_error();
		
		
		
		if($error==""){
			//success
			show_request_form();
			// send the email on success,   now its just a message aying success
			echo '<div style="text-align:center;" class="alert alert-success" <strong>Success</strong> Email has been sent!</div>';
			//create a hook for the event of a contact form being submitted by a user			
			do_action('wpdemo_request_submit');
		}
		else{
			//shows the error
			show_request_form($error);
		}//ends authenticate else
					

	}//ends the if statement
	
	else
	{
		//shows the contact form
		show_request_form();
	}//ends else


get_footer();?>