<?php

// Before VC Init
// @author Vsevolod Kurochka
add_action( 'vc_before_init', 'vc_before_init_actions' );

function vc_before_init_actions() {
	// Require new custom Element
	require_once( get_template_directory().'/visual_composer/vc-elements/vc_new_title.php' ); 

	require_once( get_template_directory().'/visual_composer/vc-elements/vc_review_type_1.php' ); 
}


// Before VC Init
add_action( 'vc_before_init', 'crypto_redeclare_before_init_actions' );

function crypto_redeclare_before_init_actions() {
	 
	// Link your VC elements's folder
	if( function_exists('vc_set_shortcodes_templates_dir') ){ 
		vc_set_shortcodes_templates_dir( get_template_directory() . '/visual_composer/vc-elements' );		 
	}
	 
}


// After VC Init
add_action( 'vc_after_init', 'vc_after_init_actions' );

function vc_after_init_actions() {
	 
	//*******************//
	// VC ROW REMAPPING //
	//*******************//
	 
	// Add Params
	$vc_row_new_params = array(
			 
			// Example
			array(
				'type' 				=> 'checkbox',
				'holder' 			=> 'h3',
				'class' 			=> 'class-name',
				'heading' 		=> __( 'Включить контейнер?', 'visotskiy' ),
				'param_name' 	=> 'container',
				'value' 			=> array(
					'Да'		=> 'container'
				),
				'description' => "",
				'admin_label' => false,
				'dependency' 	=> '',
				'weight' 			=> 1
			)
	);

	vc_add_params( 'vc_row', $vc_row_new_params );
			 
}

?>