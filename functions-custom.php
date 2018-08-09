<?php

	show_admin_bar(false);

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

	function custom_next_post($post_id){
	  $next_post = get_adjacent_post( true, '', true );
	  if (is_a($next_post, 'WP_Post')){
	  	$category = get_the_category( $next_post->ID );

	  	$echo = "<a href=" . get_permalink($next_post->ID) . " class='single-pagination__link single-pagination__link_next'>";
	  		$echo .= "<span class='single-pagination__link-category'>".esc_html( $category[0]->name )."</span>";
	  		$echo .= "<span class='single-pagination__link-name'>".get_the_title($next_post->ID)."</span>";
	    $echo .= "</a>";
	    echo $echo;
	  }
	}

	function custom_prev_post($post_id){
	  $prev_post = get_adjacent_post( true, '', false );

	  if (is_a($prev_post, 'WP_Post')){
	  	$category = get_the_category( $prev_post->ID );

	  	$echo = "<a href=" . get_permalink($prev_post->ID) . " class='single-pagination__link single-pagination__link_prev'>";
	  		$echo .= "<span class='single-pagination__link-category'>".esc_html( $category[0]->name )."</span>";
	  		$echo .= "<span class='single-pagination__link-name'>".get_the_title($prev_post->ID)."</span>";
	    $echo .= "</a>";
	    echo $echo;
	  }
	}


?>