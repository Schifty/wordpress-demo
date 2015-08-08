<?php
/*
Template Name: hotel 
*/
//gets the header
get_header();



// The Query gets the posts
$args = array('post_type' => 'hotel', 'posts_per_page' => -1);
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {

	echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		
		$image = wp_get_attachment_image_src(get_field('slide1'), 'thumbnail');
		$stars =  get_field( "stars" );
		$hotelname = get_the_slug();
		$hotelurl = curPageURL().$hotelname.'/';
		//echo $hotelurl; exit;
		echo '<div style="padding:16px;"class="col-md-4">';
		echo '<li class="centered">' . get_the_title() . '</li>';
		echo '<li style="text-align:center;">' . get_stars() . '</li>';
		echo '<li class="centered">'
		?>
		<a href="<?php echo $hotelurl; ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_field('slide1')) ?>" /></a>
		<?php
		echo'</li>';
		echo '</div>';
	}
	echo '</ul>';
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();







//gets the footer
get_footer();
?>