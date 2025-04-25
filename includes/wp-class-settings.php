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
    
    public array $sections = array( 
            /* Accodion Tab color Setting */
            [ 'section_title' => 'Display Banner section:',
                'section_fields' => array(
                    [
                        'field_name' 		=> 'Selct Pages or Post Types where you want to display slider:',
                        'field_id' 			=> 'slider_post_type',
                        'field_type' 		=> 'checkbox',
                        'field_options' 	=> 'Page|Post',
                        'field_desc' 		=> 'Selct Pages or Post Types where you want to display slider.',
                        'field_placeholder'	=> '',
                        'field_style'	    => '',
                    ],
                ),
            ],
            /* Accodion Text size Setting */
            [ 'section_title' => 'Banner Slider:',
                'section_fields' => array(
                    [
                        'field_name' 		=> 'Banner Image Height',
                        'field_id' 			=> 'slider_height',
                        'field_type' 		=> 'text',
                        'field_desc' 		=> 'Here you can set the height of the slider.',
                        'field_placeholder'	=> '600',
                        'field_style'	    => '',
                    ],
                    [
                        'field_name' 		=> 'Show Arrows',
                        'field_id' 			=> 'show_arrows',
                        'field_type' 		=> 'radio',
                        'field_options' 	=> 'Yes|No',
                        'field_desc' 		=> 'Here you can select the show arrows or not.',
                        'field_placeholder'	=> '',
                        'field_style'	    => '',
                    ],
                    [
                        'field_name' 		=> 'Show Dots',
                        'field_id' 			=> 'show_dost',
                        'field_type' 		=> 'radio',
                        'field_options' 	=> 'Yes|No',
                        'field_desc' 		=> 'Here you can select the show dots or not.',
                        'field_placeholder'	=> '',
                        'field_style'	    => '',
                    ],
                ),
            ],
        );

    public function __construct() {
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
}
