<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcReviewType1 extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_review_type_1_mapping' ) );
				add_shortcode( 'vc_review_type_1', array( $this, 'vc_review_type_1_html' ) );
		}
		 
		// Element Mapping
		public function vc_review_type_1_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Отзыв №1', 'visotskiy'),
								'base' => 'vc_review_type_1',
								'description' => __('Выберите отзыв №1', 'visotskiy'), 
								'category' => __('Для работы с сайтом', 'visotskiy'),         
								'params' => array(
										array(
											'type' => 'attach_image',
											'holder' => 'div',
											'class' => 'title-class',
											'heading' => __( 'Выберите картинку', 'visotskiy' ),
											'param_name' => 'image_url',
											'value' => __( '', 'visotskiy' ),
											'description' => __( 'Выберите картинку', 'visotskiy' ),
											'admin_label' => false,
											'weight' => 0
										),
										array(
											'type' => 'textfield',
											'holder' => 'p',
											'class' => 'title-class',
											'heading' => __( 'Заголовок:', 'visotskiy' ),
											'param_name' => 'title',
											'value' => "",
											'description' => __( 'Введите заголовок.', 'visotskiy' ),
											'admin_label' => false,
											'weight' => 0
										),
										
										array(
											"type" => "textarea_html",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Описание:", "visotskiy" ),
											"param_name" => "content",
											"value" => __( "", "visotskiy" ),
											"description" => __( "Введите описание.", "visotskiy" )
										),
								),
						)
				);
				
		}
		 
		 
		// Element HTML
		public function vc_review_type_1_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									'title' 			=> '',
									'image_url' 	=> ''
								), 
								$atts
						)
				);
				 
				// Fill $html var with data
				$img = wp_get_attachment_image_src($image_url, "large");
				$imgSrc = $img[0];

				$button_text = '';

				$html = '
				<div class="review-type-1">
					<div class="review-type-1__header">
						<img src="'.$imgSrc.'" alt="'.$title.'" class="review-type-1__header-image">
						<div class="review-type-1__header-content">
							<p class="review-type-1__header-title">'.$title.'</p>
						</div>
					</div>
					<div class="review-type-1__content">
						'.wpautop($content).'
					</div>
				</div>';

				// <a href="'.$link.'" class="btn btn_brand-1 review-type-1__btn" target="_blank">'.$button_text.'</a>
				 
				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcReviewType1();
?>