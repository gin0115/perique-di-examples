<?php

declare(strict_types=1);

/**
 * Example of a class which uses Cache as a dependency
 *
 * Uses File Cache will a custom path.
 */

namespace Gin0115\Perique_Container_Example\Cache;

use Gin0115\Perique_Container_Example\Interfaces\Cache;

class Cache_As_Dependency_C {

	public $cache;

	public function __construct( Cache $cache ) {
		$this->cache = $cache;
	}
}
