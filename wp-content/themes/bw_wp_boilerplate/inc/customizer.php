<?php
/**
 * bw_wp_boilerplate Theme Customizer
 *
 * @package bw_wp_boilerplate
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bw_wp_boilerplate_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add Address setting
	$wp_customize->add_setting( 'address_text', array(
		'default'           => __( 'Your address', 'bw_wp_boilerplate' ),
		'sanitize_callback' => 'sanitize_text'
	) );
	// Add Address control
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'address_text',
					array(
							'label'    => __( 'Address', 'bw_wp_boilerplate' ),
							'section'  => 'title_tagline',
							'settings' => 'address_text',
							'type'     => 'text'
					)
			)
	);

	// Add phone setting
	$wp_customize->add_setting( 'phone_text', array(
		'default'           => __( 'Your phone number', 'bw_wp_boilerplate' ),
		'sanitize_callback' => 'sanitize_text'
	) );
	// Add phone control
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'phone_text',
				array(
						'label'    => __( 'phone', 'bw_wp_boilerplate' ),
						'section'  => 'title_tagline',
						'settings' => 'phone_text',
						'type'     => 'text'
				)
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'bw_wp_boilerplate_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'bw_wp_boilerplate_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'bw_wp_boilerplate_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bw_wp_boilerplate_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bw_wp_boilerplate_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bw_wp_boilerplate_customize_preview_js() {
	wp_enqueue_script( 'bw_wp_boilerplate-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'bw_wp_boilerplate_customize_preview_js' );

// Sanitize text
function sanitize_text( $text ) {
	return sanitize_text_field( $text );
}