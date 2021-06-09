<?php

namespace AsasVirtuaisWordpress;

function get_plugin_data( string $plugin_file ) {
	if( ! function_exists('get_plugin_data') ){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}
	return get_plugin_data( $plugin_file, false );
}

function require_plugins( string $this_plugin, array $plugins ) {
	$return = true;
	foreach ( $plugins as $plugin_dir_file => $plugin_name ) {

		if ( ! is_plugin_active( $plugin_dir_file ) ) {
			admin_error( "The plugin $this_plugin requires the plugin $plugin_name to be installed and active." );
			$return = false;
		}
	}

	return $return;
}
