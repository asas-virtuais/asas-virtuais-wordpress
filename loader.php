<?php

return function ( $autoloader ) {
	$this_version = '1.1.2';
	add_filter( 'asas.version', function ( $version ) use ( $this_version ) {
		if ( ! $version || version_compare( $this_version, $version, '>' ) ) {
			return $this_version;
		}
		return $version;
	} );
	\add_action( 'plugins_loaded', function() use ( $this_version, $autoloader ) {
		$version = apply_filters( 'asas.version', null );
		if ( $version !== $this_version )
			return;
		if ( did_action( 'asas.load' ) > 0 )
			return;
		$autoloader->addPsr4( 'AsasVirtuaisWordpress\\', [
			plugin_dir_path( __FILE__ ) . 'libraries',
			plugin_dir_path( __FILE__ ) . 'includes',
		] );
		foreach( glob( plugin_dir_path( __FILE__ ) . 'libraries/*.php' ) as $file ) {
			include $file;
		}
		do_action( 'asas.load', $this_version );
	} );
};
