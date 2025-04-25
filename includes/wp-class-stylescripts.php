<?php 

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

class STYLESCRIPTS {
    private array $admin_style = array(
        'backend-sbs-plugin-style' => array( 'assets/backend/css/backend-style.css', array(), '0.01' ),
    );

    private array $admin_script = array(
        'backend-sbs-plugin-script' => array( 'assets/backend/js/backend-script.js', array( 'jquery' ), '0.01' ),
    );

    private array $frontend_style = array(
        'frontend-sbs-plugin-style' => array( 'assets/frontend/css/frontend-style.css', array(), '0.01' ),
        'frontend-sbs-plugin-custom-style' => array( 'assets/frontend/css/frontend-custom-style.css', array(), null ),
    );

    private array $frontend_script = array(
        'frontend-sbs-plugin-script' => array( 'assets/frontend/js/frontend-script.js', array( 'jquery' ), null ),
    );

    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'wp_sbs_script_style_admin' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'wp_sbs_script_style_frontend' ) );
    }

    public function wp_sbs_script_style_admin(): void{
        $file_url = MS_SBS_EDITING__URL;
        $file_dir = MS_SBS_EDITING__DIR;
        $current_page = get_current_screen();
        if( $current_page->base != '' ){
            foreach( $this->admin_style as $key => $value ) {
                $version = ( $value[2] != null ) ? $value[2] : filemtime( $file_dir.$value[0] ); 
                wp_register_style( $key, $file_url.$value[0], $value[1], $version );
                wp_enqueue_style( $key );
            }
            
            foreach( $this->admin_script as $key => $value ) {
                $version = ( $value[2] != null ) ? $value[2] : filemtime( $file_dir.$value[0] ); 
                wp_register_script( $key, $file_url.$value[0], $value[1], $version );
                wp_enqueue_script( $key );
            }
        }
    }

    public function wp_sbs_script_style_frontend(): void {
        $file_url = MS_SBS_EDITING__URL;
        $file_dir = MS_SBS_EDITING__DIR;
        foreach( $this->frontend_style as $key => $value ) {
            $version = ( $value[2] != null ) ? $value[2] : filemtime( $file_dir.$value[0] ); 
            wp_register_style( $key, $file_url.$value[0], $value[1], $version );
            wp_enqueue_style( $key );
        }
        
        foreach( $this->frontend_script as $key => $value ) {
            $version = ( $value[2] != null ) ? $value[2] : filemtime( $file_dir.$value[0] ); 
            wp_register_script( $key, $file_url.$value[0], $value[1], $version );
            wp_enqueue_script( $key );
        }
    }    
}