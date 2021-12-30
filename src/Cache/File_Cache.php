<?php

declare(strict_types=1);

/**
 * Example of Cache implementation
 */

namespace Gin0115\Perique_Container_Example\Cache;

use Gin0115\Perique_Container_Example\Interfaces\Cache;

class File_Cache implements Cache {

	protected $cache_location;

	public function __construct( string $cache_location = null ) {
		$this->cache_location = $cache_location;
	}

	public function create_dir_if_not_set(): void {
		// If we do not have a cache location, use the wp-uploads
		if ( null === $this->cache_location ) {
			$dirs                 = wp_get_upload_dir();
			$this->cache_location = $dirs['basedir'] . \DIRECTORY_SEPARATOR . 'file_cache';
		}

		// If our cache dir doesnt exist create.
		if ( ! \is_dir( $this->cache_location ) ) {
			mkdir( $this->cache_location );
		}
	}

	public function set( string $key, $value ): self {
		// ....
		return $this;
	}

	public function get( string $key ) {
		// ....
		return null;
	}

}
