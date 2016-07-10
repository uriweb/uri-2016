<?php
/**
 * Customizations to the admin theme
 *
 * Better unify the UX between front end and admin
 *
 * @package uri2016
 */

/**
 * Adds custom css to the admin section so that not all text areas are the same height.
 */
function uri2016_custom_admin_styles() {
  echo '<style>
    .wp-admin .field textarea {
      min-height: 0;
    } 
  </style>';
}
add_action('admin_head', 'uri2016_custom_admin_styles');

// Add CSS to Visual Editor
add_editor_style('style.css');

/**
 * Customize the color picker (Iris) palettes
 * @todo: this doesn't work... make it work!
 */
/*
function uri2016_color_picker() {
	if(wp_script_is('wp-color-picker', 'enqueued')){
		wp_enqueue_script( 'uri-color-picker', get_template_directory_uri() . '/js/uri-color-picker.js', array(), '20160510', true );
	}
}
add_action('admin_print_footer_scripts', 'uri2016_color_picker');
add_action('customize_controls_print_footer_scripts', 'uri2016_color_picker');
*/