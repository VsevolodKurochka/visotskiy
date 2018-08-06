<?php
	function generate_review( $atts ) {
		// $atts = shortcode_atts( array(
		// 	'post'   => '',
		// 	'class'	 => 'col-12 col-sm-6'
		// ), $atts );
		if ( isset($atts['post']) ) {
      $post = $atts['post'];
    }
    else {
      $post = false;
    }

    if ( isset($atts['class']) ) {
      $class = sanitize_text_field($atts['class']);
    }
    else {
      $class = 'col-12 col-sm-6';
    }

		return Timber::compile( 
			'partial/review.twig', 
			array( 
				'post' 	=> $post,
				'class'	=> $class
			) 
		);
	}
	add_shortcode('review', 'generate_review');
?>