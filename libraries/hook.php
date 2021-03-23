<?php
namespace AsasVirtuaisWordpress;


function add_safe_action( string $name, callable $callback, $priority = 10, $params = 1 ) {
	return add_anon_action( $name, safe_callback( $callback ), $priority, $params );
}

/** Pass an annonymous function and receive it back to store in a variable and reuse/remove */
function add_anon_action( string $name, callable $callback, $priority = 10, $params = 1 ) {
	add_action( $name, safe_callback( $callback ), $priority, $params );
	return $callback;
}

function safe_callback( $callback ) {
	return function( $anything ) use ( $callback ) {
		try {
			return call_user_func_array( $callback, func_get_args() );
		} catch ( \Throwable $th ) {
			admin_error_from_exception( $th );
		}
		return $anything;
	};
}

function add_safe_filter( string $name, callable $callback, $priority = 10, $params = 1 ) {
	return add_anon_filter( $name, $callback, $priority, $params );
}

/** Pass an annonymous function and receive it back to store in a variable and reuse/remove */
function add_anon_filter( string $name, callable $callback, $priority = 10, $params = 1 ) {
	add_filter( $name, $callback, $priority, $params );
	return $callback;
}
