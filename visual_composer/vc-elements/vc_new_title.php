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
								'name' => __('Заголовок', 'visotskiy'),
								'base' => 'vc_infobox',
								'description' => __('Заголовок', 'visotskiy'), 
								'category' => __('Для работы с сайтом', 'visotskiy'),         
								'params' => array(
										array(
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Заголовок", "visotskiy" ),
											"param_name" => "title",
											"value" => __( "", "visotskiy" ),
											"description" => __( "Введите Заголовок.", "visotskiy" )
										),
										array(
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Очередность заголовка", "visotskiy" ),
											"param_name" => "status",
											"value" => __( "", "visotskiy" ),
											"description" => __( "1,2,3,4,5,6", "visotskiy" )
										),
										array(
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Дополнительный класс", "visotskiy" ),
											"param_name" => "add_class",
											"value" => __( "", "visotskiy" ),
											"description" => __( "Необязательно.", "visotskiy" )
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
									'add_class' => '',
									'status'		=> '2',
									'title'			=> ''
								), 
								$atts
						)
				);
				 
				// Fill $html var with data
				$html = '<h'.$status.' class="section__title title-sm '.$add_class.'">' . $title . '</h'.$status.'>';
				 
				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcInfoBox();
?>