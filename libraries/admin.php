<?php
namespace AsasVirtuaisWordpress;

// Admin Notices
function display_admin_notice( $message, $class ) {
	echo "<div class='notice $class'><p>$message</p></div>";
}
function admin_notice( $message, $type = 'info', $dismissible = false ) {
	$class = $dismissible ? 'is-dismissible ' : '';
	$class .= "notice-$type";
	add_action( 'admin_notices', function () use ( $message, $class ) {
		display_admin_notice( $message, $class );
	} );
}
function admin_error( $message, $dismissible = false ) {
	return admin_notice( $message, 'error', $dismissible );
}
function admin_warning( $message, $dismissible = false ) {
	return admin_notice( $message, 'warning', $dismissible );
}
function admin_success( $message, $dismissible = false ) {
	return admin_notice( $message, 'success', $dismissible );
}
