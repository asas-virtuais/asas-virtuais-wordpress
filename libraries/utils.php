<?php

namespace AsasVirtuaisWordpress;

function get_plugin_data( $plugin_file ) {
	if( ! function_exists('get_plugin_data') ){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}
	return get_plugin_data( $plugin_file, false );
}
