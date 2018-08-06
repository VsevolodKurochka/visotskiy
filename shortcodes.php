<?php
	function generate_review( $atts ) {
		$atts = shortcode_atts( array(
			'href'   => 'http://site.ru',
			'height' => '550px',
			'width'  => '600px',     
		), $atts );

		return '<iframe src="'. $atts['href'] .'" width="'. $atts['width'] .'" height="'. $atts['height'] .'"> <p>Your Browser does not support Iframes.</p></iframe>';
		return Timber::compile( 'partial/review.twig', array( 'id' => $id ) );
	}
	add_shortcode('review', 'generate_review');
?>