<?php
namespace AsasVirtuaisWordpress;

function init_plugin_updater( string $url, string $plugin_file ) {
	try {
		\Puc_v4_Factory::buildUpdateChecker( $url, $plugin_file, basename( dirname( $plugin_file ) ) );
	} catch ( \Throwable $th ) {
		admin_error_from_exception( $th );
	}
}
