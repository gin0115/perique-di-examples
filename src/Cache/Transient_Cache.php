<?php

declare(strict_types=1);

/**
 * Example of Cache implementation
 */

namespace Gin0115\Perique_Container_Example\Cache;

use Gin0115\Perique_Container_Example\Interfaces\Cache;

class Transient_Cache implements Cache {

	public $prefix;

	public function __construct( string $prefix = 'acme_cache_' ) {
		$this->prefix = $prefix;
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
