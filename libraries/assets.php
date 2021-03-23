<?php
namespace AsasVirtuaisWordpress;

function register_script( $version, $name, $src, $footer = true, $deps = [] ) {
	wp_register_script( $name, $src, $deps, $version, $footer );
	return $name;
}
function register_style( $version, $name, $src, $deps = [], $media = 'all' ) {
	wp_register_style( $name, $src, $deps, $version, $media );
	return $name;
}
function register_admin_script( $version, $name, $src, $footer = true, $deps = [] ) {
	wp_register_script( $name, $src, $deps, $version, $footer );
	return $name;
}
function register_admin_style( $version, $name, $src, $deps = [], $media = 'all' ) {
	wp_register_style( $name, $src, $deps, $version, $media );
	return $name;
}

function enqueue_script( $name, $admin = false ) {
	if ( $admin ) {
		add_action( 'wp_enqueue_scripts', function() use ( $name ) {
			wp_enqueue_script( $name );
		} );
	} else {
		add_action( 'wp_enqueue_admin_scripts', function() use ( $name ) {
			wp_enqueue_script( $name );
		} );
	}
}
function enqueue_style( $name, $admin = false ) {
	if ( $admin ) {
		add_action( 'wp_enqueue_scripts', function() use ( $name ) {
			wp_enqueue_style( $name );
		} );
	} else {
		add_action( 'wp_enqueue_admin_scripts', function() use ( $name ) {
			wp_enqueue_style( $name );
		} );
	}
}
