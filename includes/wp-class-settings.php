<?php 

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

class SETTINGS {

    /**
     * @var string
     */
    private string $setting_page_name = 'Banner Setting';

    /**
     * @var string
     */
    public string $setting_page_slug = 'wp-slider-banner-setting';
    
    public array $sections = array( 
            /* Accodion Tab color Setting */
            [ 'section_title' => 'Display Banner section:',
                'section_fields' => array(
                    [
                        'field_name' 		=> 'Backgroud Color',
                        'field_id' 			=> 'tab_bg_clr',
                        'field_type' 		=> 'color',
                        'field_desc' 		=> 'Here you can add accodion background color.',
                        'field_placeholder'	=> '',
                    ],
                ),
            ],
            /* Accodion Text size Setting */
            [ 'section_title' => 'Banner Slider:',
                'section_fields' => array(
                    [
                        'field_name' 		=> 'Heading Size',
                        'field_id' 			=> 'head_size',
                        'field_type' 		=> 'number',
                        'field_desc' 		=> 'Here you can select accodion background color.',
                        'field_placeholder'	=> '',
                    ],
                    [
                        'field_name' 		=> 'Content Size',
                        'field_id' 			=> 'body_size',
                        'field_type' 		=> 'number',
                        'field_desc' 		=> 'Here you can add accodion tab text color.',
                        'field_placeholder'	=> '',
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
