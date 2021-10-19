<?php

/**
 * Template Name: Без правого сайдбара
 */

get_header();

echo "<div class=\"row\">";
		
if ( have_posts() ) {

	while ( have_posts() ) {

		the_post();

		echo "<div class=\"col-xs-12\">";
		echo "<div class=\"content clearfix\">" . do_shortcode( get_the_content() ) . "</div>";
		echo "</div>"; // .col

	} // while

} // if
			


if( comments_open($post->ID) ) comments_template();

echo "</div>"; // .row

get_footer();