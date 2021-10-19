<?php

/**
 * Template Name: Две колонки, без правого сайдбара
 */

get_header();

echo "<div class=\"row\">";
		
if ( have_posts() ) {

	while ( have_posts() ) {

		the_post();

		$content = do_shortcode( get_the_content() );
		$count = iconv_strlen( $content );

		if ( $count > 2000 ) {
			// назодим середину
			$middle = floor( $count / 2 );

			// ищем конец слова
			while ( $content[ $middle ] != ' ' ) $middle++;

			echo "<div class=\"col-md-6\">";
			echo "<div class=\"content clearfix\">" . mb_substr( $content, 0, $middle ) . "</div>";
			echo "</div>"; // .col
			echo "<div class=\"col-md-6\">";
			echo "<div class=\"content clearfix\">" . mb_substr( $content, ( $middle + 1 ) ) . "</div>";
			echo "</div>"; // .col

		} else {
			echo "<div class=\"col-xs-12\">";
			echo "<div class=\"content clearfix\">" . $content . "</div>";
			echo "</div>"; // .col
		}

	} // while

} // if

if( comments_open($post->ID) ) comments_template();

echo "</div>"; // .row

get_footer();

?>