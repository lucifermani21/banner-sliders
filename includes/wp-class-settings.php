<?php 

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

class SETTINGS {

    /**
     * @var string
     */
    private string $setting_page_name = 'Banner Settings';

    /**
     * @var string
     */
    public string $setting_page_slug = 'wp-slider-banner-setting';  
    
    public array $sections = array();

    public function __construct() {
        $this->sections = array( 
            /* Accodion Tab color Setting */
            array( 'section_title' => 'Display Banner section:',
                'section_fields' => array(
                    array(
                        'field_name' 		=> 'Select Post Types:',
                        'field_id' 			=> 'slider_post_type',
                        'field_type' 		=> 'checkbox',
                        'field_options' 	=> !empty($this->wp_ms_get_post_type_used()) ? implode('|', $this->wp_ms_get_post_type_used()) : 'post|page',
                        'field_desc' 		=> 'Selct Pages or Post Types where you want to display slider.',
                        'field_placeholder'	=> '',
                        'field_style'	    => '',
                    ),
                ),
            ),
            /* Accodion Text size Setting */
            /*array( 'section_title' => 'Banner Slider:',
                'section_fields' => array(
                    array(
                        'field_name' 		=> 'Banner Image Height',
                        'field_id' 			=> 'slider_height',
                        'field_type' 		=> 'text',
                        'field_desc' 		=> 'Here you can set the height of the slider.',
                        'field_placeholder'	=> '600',
                        'field_style'	    => '',
                    ),
                    array(
                        'field_name' 		=> 'Show Arrows',
                        'field_id' 			=> 'show_arrows',
                        'field_type' 		=> 'radio',
                        'field_options' 	=> 'Yes|No',
                        'field_desc' 		=> 'Here you can select the show arrows or not.',
                        'field_placeholder'	=> '',
                        'field_style'	    => '',
                    ),
                    array(
                        'field_name' 		=> 'Show Dots',
                        'field_id' 			=> 'show_dost',
                        'field_type' 		=> 'radio',
                        'field_options' 	=> 'Yes|No',
                        'field_desc' 		=> 'Here you can select the show dots or not.',
                        'field_placeholder'	=> '',
                        'field_style'	    => '',
                    ),
                ),
            ),*/
        );
        add_filter( 'plugin_action_links', array( $this, 'wp_banner_slider_custom_add_action_plugin' ), 10, 2 );
        add_action( 'admin_menu', array( $this, 'wp_banner_slider_admin_setting_page' ) );
        add_action( 'admin_init', array( $this, 'wp_banner_slider_admin_plugin_register_setting' ) );
    }

    /**
     * @return void
     */
    public function wp_banner_slider_admin_setting_page(): void {
        add_submenu_page(
			'options-general.php',
			$this->setting_page_name,
			$this->setting_page_name,
			'manage_options', 
			$this->setting_page_slug, 
			array( $this, 'wp_banner_slider_plugin_setting_callback' ),
			21
		);
    }

    /**
     * @return void
     */
    public function wp_banner_slider_admin_plugin_register_setting(): void{
        foreach( $this->sections as $fields_val_data ){
			foreach( $fields_val_data[ 'section_fields' ] as $a => $b ){
				register_setting( $this->setting_page_slug, $b['field_id'] );
			}
		}
    }

    /**
     * @return void
     */
    public function wp_banner_slider_plugin_setting_callback(): void {
        include( MS_SBS_EDITING__DIR.'snippets/wp-slider-settings.php' );
    }

    private function wp_ms_get_post_type_used(){
		global $wpdb;    
		$new_post_types = $wpdb->get_col( "SELECT DISTINCT post_type FROM {$wpdb->posts} WHERE post_type NOT IN ('attachment', 'revision', 'nav_menu_item', 'custom_css', 'acf-field', 'acf-field-group', 'wpcf7_contact_form')" );
		return (Array)$new_post_types;
	}

    public function wp_banner_slider_custom_add_action_plugin( $plugin_link, $plugin_file ){
		if ( $plugin_file != MS_SBS_PLUGIN_BASENAME ) {
			return $plugin_link;
		}			
		$settings_link = sprintf( __( '<a href="%s" target="_blank">Settings</a>', 'ms-banner-slider' ), esc_url( admin_url( "options-general.php?page=wp-slider-banner-setting" ) ) );;
		array_unshift( $plugin_link, $settings_link );
		return $plugin_link;
	}
}
