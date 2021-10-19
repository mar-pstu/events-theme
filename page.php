<?php

get_header();

echo "<div class=\"row\">\r\n";

echo "<div class=\"" . ( ( is_active_sidebar( 'side_right' ) ) ? 'col-sm-8' : 'col-xs-12' ) . "\">\r\n";
    
if ( have_posts() ) {

	while ( have_posts() ) {
		
		the_post();

		echo "<div class=\"content clearfix\">\r\n";
		the_content();
		echo "</div>\r\n";
		echo "<hr>";

	}

}

if ( comments_open( $post->ID ) ) comments_template();

echo "</div>\r\n"; // .col-

get_sidebar( 'right' );

echo "</div>\r\n"; // .row

get_footer();

?>