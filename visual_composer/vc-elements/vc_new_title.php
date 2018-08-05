<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcInfoBox extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_infobox_mapping' ) );
				add_shortcode( 'vc_infobox', array( $this, 'vc_infobox_html' ) );
		}
		 
		// Element Mapping
		public function vc_infobox_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Заголовок', 'crypto'),
								'base' => 'vc_infobox',
								'description' => __('Заголовок', 'crypto'), 
								'category' => __('Для работы с сайтом', 'crypto'),         
								'params' => array(
										array(
					            "type" => "textarea_html",
					            "holder" => "div",
					            "class" => "",
					            "heading" => __( "Заголовок", "crypto" ),
					            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					            "value" => __( "", "crypto" ),
					            "description" => __( "Введите Заголовок.", "crypto" )
						        ),
						        array(
					            "type" => "textfield",
					            "holder" => "div",
					            "class" => "",
					            "heading" => __( "Дополнительный класс", "crypto" ),
					            "param_name" => "add_class",
					            "value" => __( "", "crypto" ),
					            "description" => __( "Необязательно.", "crypto" )
						        )
								),
						)
				);
				
		}
		 
		 
		// Element HTML
		public function vc_infobox_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									'add_class'	=> ''
								), 
								$atts
						)
				);
				 
				// Fill $html var with data
				$html = '
				<div class="vsection-title vtitle-md '.$add_class.'">' . $content . '</div>';
				 
				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcInfoBox();
?>