<?php

if (!defined('ABSPATH')) {
    die;
}

if (!defined('MS_SBS_EDITING__DIR') || !is_dir(MS_SBS_EDITING__DIR . 'includes/')) {
    return;
}

$classes_files = glob(MS_SBS_EDITING__DIR . 'includes/*.php');
if ($classes_files === false) {
    return;
}

foreach ($classes_files as $file) {
    if (!preg_match('/^[a-zA-Z0-9\-]+\.php$/', basename($file))) {
        continue;
    }

    include_once $file;
    $base_name = basename($file, '.php');
    $class_name = strtoupper(preg_replace('/[^a-zA-Z0-9_]/', '', $base_name));

    if (!class_exists($class_name)) {
        continue;
    }

    try {
        new $class_name;
    } catch (Exception $e) {
        error_log("MS_SBS Error: Failed to load $class_name - " . $e->getMessage());
    }
}