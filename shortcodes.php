<?php
	function excerpt($id, $limit) {
		$excerpt = explode(' ', get_the_excerpt($id), $limit);

		if (count($excerpt) >= $limit) {
				array_pop($excerpt);
				$excerpt = implode(" ", $excerpt) . '...';
		} else {
				$excerpt = implode(" ", $excerpt);
		}

		$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

		return $excerpt;
	}
	add_shortcode('loop', 'fb_custom_query_shortcode');
	function fb_custom_query_shortcode( $atts ) {
		 
		 // Defaults
		 extract( shortcode_atts( array(
				'posts_per_page' 	=> '2',
				'category__in'		=> '',
				'class'						=> 'col-12 col-sm-6',
				'compare'					=> ''
		 ), $atts ) );

		 $lastposts = get_posts( array(
				'posts_per_page'	=> $posts_per_page,
				'post_type'				=> 'post',
				'post_status'			=> 'publish',
				'category__in'		=> $category__in,
				'meta_query' => array(
						array(
							'key'     		=> 'video',
							'value'				=> '',
							'compare' 		=> $compare 
						)
				)
		 ) );
		 
		 // Reset and setup variables
		 $output = '';
		 
		 // the loop
		 $output .= '<div class="row">';
			 foreach( $lastposts as $post ){ 
				setup_postdata($post);
				$temp_id 				= $post->ID;
				$temp_category 	= get_the_category($temp_id);
				$temp_title 		= get_the_title( $temp_id );
				$temp_link 			= get_permalink( $temp_id );
				$temp_image 		= get_the_post_thumbnail_url($temp_id);
				$temp_video 		= get_field('video', $temp_id);

				$temp_excerpt 	= excerpt($temp_id, 20);

				$output .= Timber::compile( 
					'partial/review.twig', 
					array( 
						'title' 		=> $temp_title,
						'link' 			=> $temp_link,
						'image'			=> $temp_image,
						'excerpt'		=> $temp_excerpt,
						'category'	=> $temp_category[0]->cat_name,
						'video'			=> $temp_video,
						'class'			=> $class
					) 
				);	
			 }
		 $output .= '</div>';
		 return $output;
		 wp_reset_postdata();
		 
?>

<?php } ?>