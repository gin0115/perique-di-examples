<?php

declare(strict_types=1);

/**
 * Example of a class that can only be populated with multiple method calls
 * methods are Fluent.
 */

namespace Gin0115\Perique_Container_Example\Nested;

class Fluent_Dependency {

	public $param_1;

	public $param_2;

	public $param_3;

	public function set_1( string $value ): self {
		$this->param_1 = $value;
		return $this;
	}

	public function set_2( string $value ): self {
		$this->param_2 = $value;
		return $this;
	}

	public function set_3( string $value ): self {
		$this->param_3 = $value;
		return $this;
	}

	public function get(): array {
		return array(
			'param_1' => $this->param_1,
			'param_2' => $this->param_2,
			'param_3' => $this->param_3,
		);
	}
}
