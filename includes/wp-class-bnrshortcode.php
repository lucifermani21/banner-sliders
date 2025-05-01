<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

class BNRSHORTCODE {
    
    var $post_id = '';
    var $meta_data = array();

    public function __construct() {
        add_shortcode( 'dynamic_slider', array( $this, 'wp_ms_dynamic_banner_slider' ) );
    }
    
    public function wp_ms_dynamic_banner_slider( $atts ) { 
        $this->post_id = get_the_ID();
        $this->meta_data = get_post_meta( $this->post_id, 'wp_banner_slider_repeatable_data', true );
        ob_start();
        $theme_file = get_template_directory().'/dynamic_banner_slider/wp-bnrshortcode.php';
		if( file_exists( $theme_file ) ){
			include( $theme_file );
        } else {
            include_once( MS_SBS_DIR__NAME . '/templates/wp-bnrshortcode.php' );
		}  
        return ob_get_clean();
    }

}