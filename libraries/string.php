<?php
namespace AsasVirtuaisWordpress;

function sanitize_title_with_underscores( $title ) {
	return str_replace( '-', '_', sanitize_title( $title ) );
}

function unslug( $slug ) {
	return ucwords( str_replace( [ '-', '_' ], ' ', $slug ) );
}
