<?php
/**
 * Betheme Child Theme
 *
 * @package Betheme Child Theme
 * @author Muffin group
 * @link https://muffingroup.com
 */

/**
 * Child Theme constants
 * You can change below constants
 */

// white label

define('WHITE_LABEL', false);

/**
 * Enqueue Styles
 */

function mfnch_enqueue_styles()
{
	// enqueue the parent stylesheet
	// however we do not need this if it is empty
	// wp_enqueue_style('parent-style', get_template_directory_uri() .'/style.css');

	// enqueue the parent RTL stylesheet

	if (is_rtl()) {
		wp_enqueue_style('mfn-rtl', get_template_directory_uri() . '/rtl.css');
	}

	// enqueue the child stylesheet

	wp_dequeue_style('style');
	wp_enqueue_style('style', get_stylesheet_directory_uri() .'/style.css');
}
add_action('wp_enqueue_scripts', 'mfnch_enqueue_styles', 101);

/**
 * Load Textdomain
 */

function mfnch_textdomain()
{
	load_child_theme_textdomain('betheme', get_stylesheet_directory() . '/languages');
	load_child_theme_textdomain('mfn-opts', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'mfnch_textdomain');


function myplugin_settings() {  
    // Add tag metabox to page
    register_taxonomy_for_object_type('post_tag', 'page'); 
    // Add category metabox to page
    register_taxonomy_for_object_type('category', 'page');  
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'init', 'myplugin_settings' );
add_filter( 'gform_field_validation_18_12', 'custom_validation', 10, 4 );
add_filter( 'gform_field_validation_19_12', 'custom_validation', 10, 4 );
add_filter( 'gform_field_validation_20_12', 'custom_validation', 10, 4 );
add_filter( 'gform_field_validation_21_12', 'custom_validation', 10, 4 );
add_filter( 'gform_field_validation_22_12', 'custom_validation', 10, 4 );
add_filter( 'gform_field_validation_23_12', 'custom_validation', 10, 4 );

function custom_validation( $result, $value, $form, $field ) {
 
    if ( $result['is_valid'] && intval( $value ) < 1 ) {
        $result['is_valid'] = false;
        $result['message'] = 'Donazione minima 1 €';
    }
    return $result;
}

