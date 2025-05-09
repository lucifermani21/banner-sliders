<?php 
/**
* Plugin Name: Dynamic Featured Banner Slider
* Description: WordPress Dynamic Featured Banner Slider for wordpress, easy to use with help of shortcodes.
* Plugin URI: https://github.com/lucifermani21/banner-sliders.git
* Version: 1.0.0
* Author: Manpreet Singh
**/

if ( ! defined( 'ABSPATH' ) ) {
     die;
}
define( 'MS_SBS_VERSION', '1.0.0' );
define( 'MS_SBS_TEXT_DOMAIN', 'ms-banner-slider' );
define( 'MS_SBS_DIR__NAME', dirname( __FILE__ ) );
define( 'MS_SBS_EDITING__URL', plugin_dir_url( __FILE__ ) );
define( 'MS_SBS_EDITING__DIR', plugin_dir_path( __FILE__ ) );
define( 'MS_SBS_PLUGIN', __FILE__ );
define( 'MS_SBS_PLUGIN_BASENAME', plugin_basename( MS_SBS_PLUGIN ) );

function wp_dfbs_plugin_init(): void {
     $loader = MS_SBS_EDITING__DIR . 'class-loader.php';
     if (file_exists($loader) ) {
          require_once $loader;
     } else {
          wp_die(__('Plugin loader file is missing.', MS_SBS_TEXT_DOMAIN));
     }
}
add_action( 'plugins_loaded', 'wp_dfbs_plugin_init' );