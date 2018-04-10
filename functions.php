<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 29/12/17
 * Time: 10:04
 */


function poncho_enqueue_styles() {
    wp_enqueue_style('roboto', get_template_directory_uri() . '/node_modules/argob-poncho/dist/css/roboto-fontface.css' );
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.min.css' );
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/node_modules/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style('poncho', get_template_directory_uri() . '/node_modules/argob-poncho/dist/css/poncho.min.css' );
}

function poncho_enqueue_scripts() {

    wp_enqueue_script('jquery', get_template_directory_uri().'/node_modules/jquery/dist/jquery.min.js', [], '1.0.0', true );
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/node_modules/bootstrap/dist/js/bootstrap.min.js', ['jquery'], '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'poncho_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'poncho_enqueue_scripts' );

?>