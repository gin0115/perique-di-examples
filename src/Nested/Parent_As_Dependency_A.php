<?php

declare(strict_types=1);

/**
 * Implementation of a class that uses the pass child type.
 */

namespace Gin0115\Perique_Container_Example\Nested;

use Gin0115\Perique_Container_Example\Nested\Parent_Service;

class Parent_As_Dependency_A {

	public $parent;

	public function __construct( Parent_Service $parent ) {
		$this->parent = $parent;
	}

}
