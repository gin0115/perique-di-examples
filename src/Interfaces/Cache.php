<?php

declare(strict_types=1);

/**
 * Example of an interface for caching.
 */

namespace Gin0115\Perique_Container_Example\Interfaces;

interface Cache {

	public function set( string $key, $value): self;

	public function get( string $key);

}
