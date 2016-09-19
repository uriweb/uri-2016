<?php
/**
 * uri2016 Theme Customizer.
 *
 * @package uri2016
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uri2016_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// rename "Header Image" section to "Header"
	$wp_customize->get_section('header_image')->title = esc_html__( 'Header', 'uri2016' );

	// header background color
	$wp_customize->add_setting( 'header_bg_color', array(
		'default' => '#aad1ff',
		'sanitize_callback' => 'sanitize_hex_color',
 		'type' => 'theme_mod',
 		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'header_bg_color',
		array(
			'label'    => __( 'Header Background Color', 'uri2016' ),
			'description' => __( 'This color is only seen when there is no header image.', 'uri2016' ),
			'section'  => 'header_image',
			'capability' => 'edit_theme_options',
			'settings' => 'header_bg_color',
			'priority' => 10,
			'palette' => array('#404040','#002147','#aad1ff','#d0a627','#f9edaf')
		) 
	));
	

	// header text tinted background
	$wp_customize->add_setting( 'header_text_tint', array(
		'default' => '1',
		'sanitize_callback' => '',
 		'type' => 'theme_mod',
 		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Control( 
		$wp_customize, 
		'header_text_tint',
		array(
			'label'    => __( 'Tint the Header Text Background', 'uri2016' ),
			'description' => __( 'Darkens the area around header text.', 'uri2016'),
			'section'  => 'header_image',
			'capability' => 'edit_theme_options',
	 		'type' => 'checkbox',
			'settings' => 'header_text_tint',
			'priority' => 20,
			'input_attrs' => array(
				'checked' => ''
			)
		) 
	));

	
}
add_action( 'customize_register', 'uri2016_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function uri2016_customize_preview_js() {
	wp_enqueue_script( 'uri2016_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'uri2016_customize_preview_js' );
