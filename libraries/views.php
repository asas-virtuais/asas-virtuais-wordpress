<?php
namespace AsasVirtuaisWordpress;

function load_view( string $view, $data = [] ) {
	return require_view( $view, $data, false );
}
function render_view( string $view, $data = [] ) {
	return require_view( $view, $data, true );
}
function require_view( string $view, $data = [], $echo = false ) {

	try {

		if ( $data ) {
			extract( $data, EXTR_SKIP );
		}
	
		if ( $echo === true ) {

			return include( $view );

		} else {
	
			ob_start();
	
			$return = include( $view );
			if ( $return ) {
				$return = ob_get_contents();
			}
	
			ob_end_clean();
	
			return $return;
		}
	
	} catch (\Throwable $th) {
		$details = "<pre>" . get_error_details( $th ) . "</pre>";
		if ( $echo ) {
			echo $details;
		} else {
			return $details;
		}
	}
}

