<?php

namespace AsasVirtuaisWordpress;

function admin_error_from_exception( \Throwable $th ) {
	return admin_error( '<pre>' . get_error_details( $th ) . '</pre>' );
}

function get_error_details( \Throwable $e ) {
	$msg = "\n";
	$class = get_class($e);
	$e_msg = $e->getMessage();
	$msg .= "File: {$e->getFile()}\n";
	$msg .= "Line: {$e->getLine()}\n";
	$msg .= "Type: {$class}\n";
	$msg .= "Msg: $e_msg\n";
	$previous = $e->getPrevious();
	if ( $previous ) {
		$msg .= get_error_details( $previous );
	}
	return $msg;
}

function wp_error_message( \WP_Error $wp_error ) {
	$errors   = implode( "\n", $wp_error->get_error_codes() );
	$messages = implode( "\n", $wp_error->get_error_messages() );
	return "WP_Error \n code: \n $errors \n messages: \n $messages ";
}

