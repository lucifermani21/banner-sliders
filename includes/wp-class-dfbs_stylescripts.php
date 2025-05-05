<?php
if (!defined('ABSPATH')) {
    die;
}

class DFBS_STYLESCRIPTS {
    private array $admin_style = [
        'backend-sbs-plugin-style' => ['assets/backend/css/backend-style.css', [], null],
    ];

    private array $admin_script = [
        'backend-sbs-plugin-script' => ['assets/backend/js/backend-script.js', ['jquery'], null],
    ];

    private array $frontend_style = [
        'frontend-sbs-plugin-style' => ['assets/frontend/css/frontend-style.css', [], null],
    ];

    private array $frontend_script = [
        'frontend-sbs-plugin-script' => ['assets/frontend/js/frontend-script.js', ['jquery'], null],
    ];

    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'wp_sbs_script_style_admin']);
        add_action('wp_enqueue_scripts', [$this, 'wp_sbs_script_style_frontend']);
    }

    public function wp_sbs_script_style_admin(): void {
        if (!defined('MS_SBS_EDITING__URL') || !defined('MS_SBS_EDITING__DIR')) {
            return;
        }

        $screen = get_current_screen();
        if (!$screen || strpos($screen->id, 'my-plugin-slug') === false) {
            return; // Only load on specific admin pages
        }

        $this->enqueue_assets($this->admin_style, $this->admin_script);
    }

    public function wp_sbs_script_style_frontend(): void {
        if (!defined('MS_SBS_EDITING__URL') || !defined('MS_SBS_EDITING__DIR')) {
            return;
        }

        $this->enqueue_assets($this->frontend_style, $this->frontend_script);
    }

    private function enqueue_assets(array $styles, array $scripts): void {
        foreach ($styles as $key => $value) {
            $file_path = MS_SBS_EDITING__DIR . $value[0];
            $version = $value[2] ?? (file_exists($file_path) ? filemtime($file_path) : null);
            wp_register_style($key, MS_SBS_EDITING__URL . $value[0], $value[1], $version);
            wp_enqueue_style($key);
        }

        foreach ($scripts as $key => $value) {
            $file_path = MS_SBS_EDITING__DIR . $value[0];
            $version = $value[2] ?? (file_exists($file_path) ? filemtime($file_path) : null);
            wp_register_script($key, MS_SBS_EDITING__URL . $value[0], $value[1], $version, true);
            wp_enqueue_script($key);
        }
    }
}