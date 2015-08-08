<?php
/**
 * Single hotel Posts Template
 *
 *
 * @file           single-hotel.php
 * @package        StanleyWP child
 * @author         Brad Williams & Carlos Alvarez
 * @copyright      2011 - 2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Theme_Development#Single_Post_.28single.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

<div id="content">
<?php
		
// The Query gets the posts
$postid = get_the_id();
$args = array('post_type' => 'hotel', 'p' => $postid );
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {

	
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$image = wp_get_attachment_image_src(get_field('slide1'), 'thumbnail');
		$stars =  get_field( "stars" );
		$hotelname = get_the_slug();
		$hotelurl = curPageURL().$hotelname.'/';
		
		
		
		echo ' <div id="white">
               <div class="container">
               <div class="row">
               <div class="col-lg-8 col-lg-offset-2">';
		?>
		  <h1><?php the_title(); ?>&nbsp;&nbsp;&nbsp;<?php echo get_stars(); ?></h1>
		  <h4><?php echo get_field( "address" ); ?></h4>
		  <hr/>
	
		
		<?php
       $slide1 = wp_get_attachment_image_src(get_field('slide1'), 'full');
	   $slide1thumb = wp_get_attachment_image_src(get_field('slide1'), 'thumbnail');
	   $slide2 = wp_get_attachment_image_src(get_field('slide2'), 'full');
	   $slide2thumb = wp_get_attachment_image_src(get_field('slide2'), 'thumbnail');
	   $slide3 = wp_get_attachment_image_src(get_field('slide3'), 'full');
	   $slide3thumb = wp_get_attachment_image_src(get_field('slide3'), 'thumbnail');
	   $slide4 = wp_get_attachment_image_src(get_field('slide4'), 'full');
	   $slide4thumb = wp_get_attachment_image_src(get_field('slide4'), 'thumbnail');
	   $slide5 = wp_get_attachment_image_src(get_field('slide5'), 'full');
	   $slide5thumb = wp_get_attachment_image_src(get_field('slide5'), 'thumbnail');
	
	//echo $slide5thumb; exit;
	?>
		
		
		<div id="wrapper">

        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
				<img src="<?php echo $slide1[0]; ?> " data-thumb="<?php echo $slide1thumb[0]; ?>" alt="<?php echo get_the_title(get_field('slide1')) ?>" />
                <img src="<?php echo $slide2[0]; ?> " data-thumb="<?php echo $slide2thumb[0]; ?>" alt="<?php echo get_the_title(get_field('slide2')) ?>" />
				<img src="<?php echo $slide3[0]; ?> " data-thumb="<?php echo $slide3thumb[0]; ?>" alt="<?php echo get_the_title(get_field('slide3')) ?>" />
				<img src="<?php echo $slide4[0]; ?> " data-thumb="<?php echo $slide4thumb[0]; ?>" alt="<?php echo get_the_title(get_field('slide4')) ?>" />
				<img src="<?php echo $slide5[0]; ?> " data-thumb="<?php echo $slide5thumb[0]; ?>" alt="<?php echo get_the_title(get_field('slide5')) ?>" />
			</div>
        </div>

    </div>
		
		
		
		
		 <p><?php echo get_field( "hotel_description" ); ?> </p>
		<?php echo '</div></div></div></div>'; 
		
		
		
		
		

	}
}
?>
   </div><!-- end of #content -->



   <?php get_footer(); ?>
