<?php

return function ( $autoloader ) {
	$this_version = '1.1.1';
	add_filter( 'asas.version', function ( $version ) use ( $this_version ) {
		if ( ! $version || version_compare( $this_version, $version, '>' ) ) {
			return $this_version;
		}
		return $version;
	} );
	add_action( 'plugins_loaded', function() use ( $this_version, $autoloader ) {
		$version = apply_filters( 'asas.version', null );
		if ( $version !== $this_version )
			return;
		if ( did_action( 'asas.load' ) > 0 )
			return;
		$autoloader->addPsr4( 'AsasVirtuaisWordpress\\', [
			__DIR__ . '/libraries/',
			__DIR__ . '/includes/',
		] );
		do_action( 'asas.load', $this_version );
	} );
};
