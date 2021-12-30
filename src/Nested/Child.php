<?php

declare(strict_types=1);

/**
 * The Child "Service" in the nested example.
 */

namespace Gin0115\Perique_Container_Example\Nested;

use Gin0115\Perique_Container_Example\Nested\Fluent_Dependency;

class Child {

	public $fluid_dependency;

	public function __construct( Fluent_Dependency $fluid_dependency ) {
		$this->fluid_dependency = $fluid_dependency;
	}
}
