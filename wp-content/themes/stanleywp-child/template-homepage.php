<?php
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: Homepage
 */
?>

<?php get_header(); ?>



	<div id="wrapper">

        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
				<img src="<?php echo get_stylesheet_directory_uri().'/images/toystory.jpg';?>" data-thumb="<?php echo get_stylesheet_directory_uri().'images/toystory.jpg';?>" alt="" />
                <a href="http://dev7studios.com"><img src="<?php echo get_stylesheet_directory_uri().'/images/up.jpg';?>" data-thumb="<?php echo get_stylesheet_directory_uri().'/images/up.jpg';?>" alt="" title="This is an example of a caption" /></a>
                <img src="<?php echo get_stylesheet_directory_uri().'/images/walle.jpg';?>" data-thumb="<?php echo get_stylesheet_directory_uri().'/images/walle.jpg';?>" alt="" data-transition="slideInLeft" />
                <img src="<?php echo get_stylesheet_directory_uri().'/images/nemo.jpg';?>" data-thumb="<?php echo get_stylesheet_directory_uri().'/images/nemo.jpg';?>" alt="" title="#htmlcaption" />
				
			</div>
        </div>

    </div>



<div class="home-wrap clearfix">
	<?php
	// Loop through homepage modules and get their corresponding files
	// See your theme's includes folder for editing these modules
    global $smof_data;
    $homepage_modules = $smof_data['homepage_blocks']['enabled'];
    if ($homepage_modules):
		// Loop through each module
    	foreach ($homepage_modules as $key=>$value) :
			$value = preg_replace('/\s*/', '', $value); // remove white spaces
			$value = strtolower($value); // lowercase
    		get_template_part('includes/home', $value); // get correct file for each module
   		endforeach;
	endif; ?>
</div><!-- END home-wrap -->

<?php get_footer(); ?>