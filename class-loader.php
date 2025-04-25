<?php 

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

$classes_files = glob( MS_SBS_EDITING__DIR. 'includes/*.php');

$class_array = array();

foreach( $classes_files as $key => $file ){
    include $file;
    $class_array[] = strtoupper( basename( str_replace(  array( 'wp-class-', '.php' ), '', $file ) ) );
}

foreach( array_unique( $class_array ) as $class_name ) {
    new $class_name;
}