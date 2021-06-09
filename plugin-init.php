<?php
/**
 * Plugin Name: Plugin Name
 * Version: 1.0.0
 * Description:
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

 // Everything inside this function to avoid global changes
(function() {

	$admin_notice_exception = function( $th ) {
		add_action( 'admin_notices', function() use ( $th ) {
			$msg  = $th->getMessage();
			$line = $th->getLine();
			$file = $th->getFile();
			$message = "<pre>Error: $msg\nFile:  $file\nLine:  $line\n" . print_r( $th, true ) . '</pre>';
			echo "<div class='notice notice-error'><p>$message</p></div>";
		} );
	};

	// Everything in a try/catch to avoid crashing websites
	try {
		$plugin_dir = plugin_dir_path( __FILE__ );
		// Require autoload or throw
		if ( file_exists( $plugin_dir . 'vendor/autoload.php' ) ) {
			$autoload = require_once $plugin_dir . 'vendor/autoload.php';
		} else {
			throw new \Exception( 'Autoload not present' );
		}
		// Require framework loader or throw
		if ( file_exists( $plugin_dir . 'vendor/asas-virtuais/asas-virtuais-wordpress/loader.php' ) ) {
			$framework_loader = require_once $plugin_dir . 'vendor/asas-virtuais/asas-virtuais-wordpress/loader.php';
		} else {
			throw new \Exception( 'Framework loader.php not present' );
		}
		// Do your stuff only after plugins_loaded hook
		add_action( 'plugins_loaded', function() use ( $autoload, $framework_loader, $admin_notice_exception ) {
			try {
				$framework = $framework_loader( $autoload );

				$plugin_data = AsasVirtuaisWordpress\get_plugin_data( __FILE__ );

				$continue = AsasVirtuaisWordpress\require_plugins( $plugin_data['Name'], [
				] );

				if ( $continue ) {
					AsasVirtuaisWordpress\init_plugin_updater( 'http://playground.gsgmothership.com/pre-release-updater/wp-update-server/?action=get_metadata&slug=gsg-products', __FILE__ );
					include_once $framework->plugin_dir . 'plugin-lib.php';
				}

			} catch ( \Throwable $th ) {
				$admin_notice_exception( $th );
			}
		} );
	} catch ( \Throwable $th ) {
		$admin_notice_exception( $th );
	}
})();
