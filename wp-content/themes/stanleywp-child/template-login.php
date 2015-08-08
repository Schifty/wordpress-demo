<?php 
/*Template name: Login Form*/

// get the header
get_header();?>
		
	<div class="centered">
<?php

?>
	</div><!--ends div centered-->
		
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 centered">
		<?php
		
			$args=array('redirect' => site_url());
		
			wp_login_form($args); ?>
		</div><!--ends lg8 offset2-->	
	</div><!--ends row-->
</div><!--ends container-->


<?php
//gets the footer
get_footer();
?>