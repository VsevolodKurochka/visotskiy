<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcNewIcon extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_new_icon_mapping' ) );
				add_shortcode( 'vc_new_icon', array( $this, 'vc_new_icon_html' ) );
		}
		 
		// Element Mapping
		public function vc_new_icon_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Блок с иконкой и кнопкой', 'visotskiy'),
								'base' => 'vc_new_icon',
								'description' => __('', 'visotskiy'), 
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
											"type" => "textarea_html",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Описание:", "visotskiy" ),
											"param_name" => "content",
											"value" => __( "", "visotskiy" ),
											"description" => __( "Введите описание.", "visotskiy" )
										),

										array(
											'type' => 'textfield',
											'holder' => 'p',
											'class' => 'title-class',
											'heading' => __( 'Название кнопки:', 'visotskiy' ),
											'param_name' => 'btn_name',
											'value' => "",
											'description' => __( 'Введите название кнопки.', 'visotskiy' ),
											'admin_label' => false,
											'weight' => 0
										),

										array(
											'type' => 'vc_link',
											'holder' => 'p',
											'class' => 'title-class',
											'heading' => __( 'Ссылка кнопки:', 'visotskiy' ),
											'param_name' => 'btn_link',
											'value' => "",
											'description' => __( 'Введите ссылку кнопки.', 'visotskiy' ),
											'admin_label' => false,
											'weight' => 0
										),

								),
						)
				);
				
		}
		 
		 
		// Element HTML
		public function vc_new_icon_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									'image_url' 	=> '',
									'btn_name'		=> '',
									'btn_link'		=> ''
								), 
								$atts
						)
				);
				 
				// Fill $html var with data
				$img = wp_get_attachment_image_url($image_url, 'full');

				$btn_href = vc_build_link($btn_link);
				$html = '
				<div class="icon">
					<div class="icon__header">
						<img src="'.$img.'" alt="'.$title.'" class="icon__header-image">
					</div>
					<div class="icon__content article">
						'.wpautop($content).'
					</div>
					<div class="icon__footer">
						<a href="'.site_url($btn_href["url"]).'" class="btn btn_brand-1 icon__btn effect effect_bounce-top" target="_blank">'.$btn_name.'</a>
					</div>
				</div>';

				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcNewIcon();
?>