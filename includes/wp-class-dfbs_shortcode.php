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
        $this->meta_data = get_post_meta($this->post_id, 'wp_banner_slider_repeatable_data', true);
        $layout = isset($atts['layout']) ? sanitize_file_name($atts['layout']) : '1';
        
        // Determine the layout file name
        $layout_file_name = 'dfbs-layout-' . $layout . '.php';
        $default_file_name = 'dfbs-layout-1.php';
        
        // First check theme directory
        $theme_dir = get_template_directory() . '/dynamic_banner_slider/';
        $theme_file = $theme_dir . $layout_file_name;
        $theme_default = $theme_dir . $default_file_name;
        
        // Then check plugin directory
        $plugin_dir = MS_SBS_DIR__NAME . '/templates/';
        //$plugin_file = $plugin_dir . $layout_file_name;
        $plugin_default = $plugin_dir . $default_file_name;
        
        ob_start();
        
        // Check theme files first
        if ( ( is_dir($theme_dir) == true ) && ( file_exists($theme_file) == true ) ) {
            include_once($theme_file);
        } else {
            include_once($plugin_default);
        }
        return ob_get_clean();
    }

}