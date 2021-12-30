<?php

declare(strict_types=1);

/**
 * The Parent "Service" in the nested example.
 */

namespace Gin0115\Perique_Container_Example\Nested;

use Gin0115\Perique_Container_Example\Nested\Fluent_Dependency;

class Parent_Service {

	public $child;

	public function __construct( Child $child ) {
		$this->child = $child;
	}
}
