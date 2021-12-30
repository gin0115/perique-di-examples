<?php

declare(strict_types=1);

/**
 * Example of using the Hookable Interface to create a class
 * which can be used to register menu pages.
 */

namespace Gin0115\Perique_Container_Example;

use PinkCrab\Loader\Hook_Loader;
use PinkCrab\Perique\Interfaces\Hookable;
use PinkCrab\Perique\Interfaces\DI_Container;
use Gin0115\Perique_Container_Example\Cache\File_Cache;
use Gin0115\Perique_Container_Example\Cache\Transient_Cache;
use Gin0115\Perique_Container_Example\Nested\Parent_Service;
use Gin0115\Perique_Container_Example\Cache\Cache_As_Dependency_A;
use Gin0115\Perique_Container_Example\Cache\Cache_As_Dependency_B;
use Gin0115\Perique_Container_Example\Cache\Cache_As_Dependency_C;
use Gin0115\Perique_Container_Example\Cache\Cache_As_Dependency_D;
use Gin0115\Perique_Container_Example\Nested\Parent_As_Dependency_A;
use Gin0115\Perique_Container_Example\Nested\Parent_As_Dependency_B;

class Menu_Pages implements Hookable {

	private $di_container;

	/**
	 * Pass in DI Container so the template can access the DI Container to
	 * create the objects.
	 *
	 * This is handled automatically through the registration process.
	 *
	 * @param DI_Container $di_container
	 */
	public function __construct( DI_Container $di_container ) {
		$this->di_container = $di_container;
	}

	/**
	 * Is called by the Registration process, and allows registering hook
	 * callbacks.
	 *
	 * @param Hook_Loader $loader
	 * @return void
	 */
	public function register( Hook_Loader $loader ): void {
		$loader->admin_action( 'admin_menu', array( $this, 'register_pages' ) );
	}

	/**
	 * Callback for registering the page(s)
	 *
	 * @return void
	 */
	public function register_pages(): void {
		\add_menu_page(
			'DI Container (Cache)',
			'DI Container (Cache)',
			'manage_options',
			'perique_di_ex_cache',
			$this->cache_interface_example_view(),
			'page',
			10
		);

		\add_submenu_page(
			'perique_di_ex_cache',
			'DI Container (Nested)',
			'DI Container (Nested)',
			'manage_options',
			'perique_di_ex_nested',
			$this->nested_example_view(),
		);

	}

	/**
	 * Returns the callable used to render the cache example pages view
	 *
	 * @return callable
	 */
	private function cache_interface_example_view(): callable {
		return function() {
			echo '<pre><code>';

			// Instance of File Cache created with default details via method call.
			print_r( $this->di_container->create( File_Cache::class ) );

			// Instance of Transient Cache created with default details, passed to constructor
			print_r( $this->di_container->create( Transient_Cache::class ) );

			// As a File Cache instance passed as a substitution.
			print_r( $this->di_container->create( Cache_As_Dependency_A::class ) );

			// Using the fallback File Cache instance, with single method call.
			print_r( $this->di_container->create( Cache_As_Dependency_B::class ) );

			// As Transient Cache, but passed using a dynamic, shared instance
			print_r( $this->di_container->create( Cache_As_Dependency_C::class ) );

			// Using the fallback Transient Cache implementation
			print_r( $this->di_container->create( Cache_As_Dependency_D::class ) );

			echo '</pre></code>';
		};
	}

	/**
	 * Returns the callable used to render the nested example page view.
	 *
	 * @return callable
	 */
	private function nested_example_view(): callable {
		return function() {
			echo '<pre><code>';

			// Creates a parent service with no custom rules for the Fluent Dependency
			print_r( $this->di_container->create( Parent_Service::class ) );

			// Create the A class with nested dependencies. Will use base Child and the
			// default/fallback fluent call values.
			print_r( $this->di_container->create( Parent_As_Dependency_A::class ) );

			// Creates the B class with nested dependencies . Will use the HotSwapped Child instance and
			// matching fluent dep values.
			print_r( $this->di_container->create( Parent_As_Dependency_B::class ) );

			echo '</pre></code>';
		};
	}
}
