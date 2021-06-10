<?php
namespace AsasVirtuaisWordpress;

function register_rest_route( string $namespace, string $route, array $args = [], $override = false ) {
	$args['callback'] = safe_callback( $args['callback'] );
	return \register_rest_route( $namespace, $route, $args, $override );
}

function ajax_action( string $action, callable $callback, $priority = 10, $accepted = 1 ) {
	return add_safe_action( "wp_ajax_$action", $callback, $priority, $accepted );
}
