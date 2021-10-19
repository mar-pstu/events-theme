<?php


define( 'EVENTS_THEME_URL', get_template_directory_uri() . '/' );
define( 'EVENTS_THEME_DIR', get_template_directory() . '/' );


add_action( 'after_setup_theme', function () {

	// загрузка текстового домена
	load_theme_textdomain( 'events-theme', EVENTS_THEME_DIR . 'languages/' );

	// опции темы
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );
    add_theme_support( 'custom-header' );
	add_theme_support( 'automatic-feed-links' );
	remove_filter( 'the_content', 'wpautop' );
	remove_filter( 'the_excerpt', 'wpautop' );
	add_filter( 'widget_text', 'do_shortcode' );

} );


add_filter( 'wp_pagenavi', function($html){
    // Remove div.
    $html = trim(preg_replace('/<\/?div([^>]*)?>/u', '', $html));
    // Wrap links with li.
    $html = preg_replace('/(<a[^>]*>[^<]*<\/a>)/u', '<li>$1</li>', $html);
    // Wrap links with span considering class name.
    $html = preg_replace_callback('/<span([^>]*?)>[^<]*<\/span>/u', function($matches){
        if( false !== strpos($matches[1], 'current') ){
            // This is current page.
            $class_name = 'active';
        }elseif( false !== strpos($matches[1], 'pages') ){
            // This is page number.
            $class_name = 'disabled';
        }elseif( false !== strpos($matches[1], 'extend') ){
            // This is ellipsis.
            $class_name = 'disabled';
        }else{
            // No class.
            $class_name = '';
        }
        return "<li class=\"{$class_name}\">{$matches[0]}</li>";
    }, $html);
    // Wrap with ul as you like.
    return <<<HTML
<div class="row text-center">
    <ul class="pagination">{$html}</ul>
</div>
HTML;
}, 10, 2 );



require_once EVENTS_THEME_DIR . 'includes/library.php';
require_once EVENTS_THEME_DIR . 'includes/customizer.php';
require_once EVENTS_THEME_DIR . 'includes/enqueue.php';
require_once EVENTS_THEME_DIR . 'includes/sidebars.php';
require_once EVENTS_THEME_DIR . 'includes/menus.php';
require_once EVENTS_THEME_DIR . 'includes/metabox-contacts.php';


get_template_part( 'shortcodes/accordio-list' );
get_template_part( 'shortcodes/tabs' );