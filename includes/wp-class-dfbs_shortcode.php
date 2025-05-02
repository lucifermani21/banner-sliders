<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

class DFBS_SHORTCODE {
    
    var $post_id = '';
    var $meta_data = array();

    public function __construct() {
        add_shortcode( 'dynamic_slider', array( $this, 'wp_ms_dynamic_banner_slider' ) );
    }
    
    public function wp_ms_dynamic_banner_slider( $atts ) {
        $this->post_id = get_the_ID();
        $this->meta_data = get_post_meta( $this->post_id, 'wp_banner_slider_repeatable_data', true );
        $layout = isset( $atts['layout'] ) ? $atts['layout'] : '1';
        ob_start();
        $plguin_temp_files = glob( MS_SBS_DIR__NAME . '/templates/dfbs-layout-*.php' );
        $theme_temp_file = glob( get_template_directory().'/dynamic_banner_slider/dfbs-layout-*.php' );
		if( !empty( $theme_temp_file ) ) {
            include_once( get_template_directory().'/dynamic_banner_slider/dfbs-layout-'.$layout.'.php' );
        } else {
            include_once( MS_SBS_DIR__NAME . '/templates/dfbs-layout-'.$layout.'.php' );
		}
        return ob_get_clean();
    }

}