<?php
	
	/*	
	Plugin Name: Pixelbar Simple Google Map
	Author: Adrian Lambertz
	Description: Fügt die Google Map Funktionalität hinzu. Einfach Plugin installieren und über Shortcode einfügen. Scripts werden selektiv geladen.
	Plugin URI: https://github.com/PixelbarEupen/pix-google-map
	Version: 0.1.1
	GitHub Plugin URI: https://github.com/PixelbarEupen/pix-google-map
	GitHub Access Token: 6ca583973da0e33ee1a6c90c3e4920e6143369ca
	*/
	
	
	/******************************************************************************************/
	/************************* DO NOT CHANGE ANYTHING AFTER THIS LINE *************************/
	
	//hook to register all necessary scripts
	add_action('init', 'pix_register_maplace_script');
	
	//hook to print the scripts into the footer
	add_action('wp_footer', 'pix_add_maplace_script');
	
		
	
	if(!function_exists(google_map)){
		//shortcode function
		function google_map($atts) {
			extract( shortcode_atts( array(
			      'lat' => '',
			      'lon' => '',
			      'marker' => '',
			      'zoom' => '',
			      'height' => '300'
		     ), $atts ) );
			
			global $pix_add_maplace_script;
			$pix_add_maplace_script = true;
		
			$rand = rand(1, 9999999999);
			
			$lat = ($lat != '') ? $lat = 'data-lat="'.$lat.'"' : $lat = '';
			$lon = ($lon != '') ? $lon = 'data-lon="'.$lon.'"' : $lon = '';
			$zoom = ($zoom != '') ? $zoom = 'data-zoom="'.$zoom.'"' : $zoom = '';
			$marker = ($marker != '') ? $marker = 'data-marker="'.$marker.'"' : $marker = '';
			$height = ($height != '') ? $height = 'style="height: '.$height.'px;"' : $height = '';
			
			$output = '<div 
							class="gmap"
							id="gmap-'.$rand.'"
							'.$marker.'
							'.$lat.'
							'.$lon.'
							'.$zoom.'
							'.$height.'
						>
						</div>';
			
			
			return $output;
		}
		//shortcode handler
		add_shortcode('map', 'google_map');

	}
	
	//register script function
	if(!function_exists(pix_register_maplace_script)){	
		function pix_register_maplace_script() {
			wp_register_script( 'googlemap', 'http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7');
			wp_register_script( 'maplace', plugins_url( '/js/maplace.js' , __FILE__ ));
			wp_register_script( 'maplace-custom', plugins_url( '/js/maplace-custom.js' , __FILE__ ));
		}
	}
	
	
	//print script function
	if(!function_exists(pix_add_maplace_script)){	
		function pix_add_maplace_script() {
			global $pix_add_maplace_script;
		
			if ( ! $pix_add_maplace_script )
				return;
	
			wp_print_scripts('googlemap');
			wp_print_scripts('maplace');
			wp_print_scripts('maplace-custom');
		}
	}
	
	

?>
