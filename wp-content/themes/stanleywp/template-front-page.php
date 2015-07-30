<?php
/**
 * @package WordPress
 * Template Name: Front-page.php
 */
?>

<?php get_header(); ?>

	<div class="slider-wrapper theme-default">
			<div id="slider" class="nivoSlider">
                <img src="<?php echo get_stylesheet_directory_uri().'/images/toystory.jpg';?>" data-thumb="images/toystory.jpg" alt="" />
                <a href="http://dev7studios.com"><img src="<?php echo get_stylesheet_directory_uri().'/images/up.jpg';?>" data-thumb="images/up.jpg" alt="" title="This is an example of a caption" /></a>
                <img src="<?php echo get_stylesheet_directory_uri().'/images/walle.jpg';?>" data-thumb="images/walle.jpg" alt="" />
                <img src="<?php echo get_stylesheet_directory_uri().'/images/nemo.jpg';?>" data-thumb="images/nemo.jpg" alt="" title="#htmlcaption" />
            </div>
            <div id="htmlcaption" class="nivo-html-caption">
                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
            </div>
    </div>

<?php get_footer(); ?>