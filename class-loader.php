<?php 

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

$classes_files = glob( MS_SBS_EDITING__DIR. 'includes/*.php');

if ($classes_files === false) {
    return;
}

$class_array = array();

foreach( $classes_files as $key => $file ){
    include_once $file;
    $class_array[] = strtoupper( basename( str_replace(  array( 'wp-class-', '.php' ), '', $file ) ) );
}

foreach( array_unique( $class_array ) as $class_name ) {
    if (!class_exists($class_name)) {
        continue;
    }

    try {
        new $class_name;
    } catch (Exception $e) {
        error_log("MS_SBS Error: Failed to load $class_name - " . $e->getMessage());
    }
}