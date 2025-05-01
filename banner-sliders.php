<?php 
/**
* Plugin Name: Dynamic Featured Banner Slider
* Description: WordPress Dynamic Featured Banner Slider for wordpress, easy to use with help of shortcodes.
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

function wp_sbs_plugin_init(): void {
     include MS_SBS_DIR__NAME. '/class-loader.php';
}
add_action( 'plugins_loaded', 'wp_sbs_plugin_init' );