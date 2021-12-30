<?php

/**
 * Plugin Name: PinkCrab Perique DI Container Example
 * Plugin URI: https://github.com/gin0115/perique-di-examples
 * Description: A selection of examples of using the DI Container with the Perique Framework (https://github.com/Pink-Crab/Perqiue-Framework/)
 * Version: 1.0.0
 * Author: Glynn Quelch
 * Author URI: https://github.com/gin0115/perique-di-examples
 * Text Domain: gin0115-pinkcrab-examples
 * Domain Path: /languages
 * Tested up to: 5.8
 * License: MIT
 **/

use Dice\Dice;
use PinkCrab\Perique\Application\App_Factory;
use Gin0115\Perique_Container_Example\Menu_Pages;
use Gin0115\Perique_Container_Example\Nested\Child;
use Gin0115\Perique_Container_Example\Cache\File_Cache;
use Gin0115\Perique_Container_Example\Interfaces\Cache;
use Gin0115\Perique_Container_Example\Cache\Transient_Cache;
use Gin0115\Perique_Container_Example\Nested\Parent_Service;
use Gin0115\Perique_Container_Example\Nested\Fluent_Dependency;
use Gin0115\Perique_Container_Example\Nested\Hot_Swapped_Child;
use Gin0115\Perique_Container_Example\Cache\Cache_As_Dependency_A;
use Gin0115\Perique_Container_Example\Cache\Cache_As_Dependency_B;
use Gin0115\Perique_Container_Example\Cache\Cache_As_Dependency_C;
use Gin0115\Perique_Container_Example\Cache\Cache_As_Dependency_D;
use Gin0115\Perique_Container_Example\Nested\Parent_As_Dependency_B;

require_once __DIR__ . '/vendor/autoload.php';

// DI Rules (Usually you would have this in config/dependencies.php)
$dependencies = array(

	## ** Cache Examples ** ##

	// Default/Fallback for File Cache
	File_Cache::class             => array(
		'call' => array(
			array( 'create_dir_if_not_set', array( /*No params needed, as no args passed to method*/ ) ),
		),
	),

	// Default/fallback details for Transient Cache
	Transient_Cache::class        => array(
		'instanceOf'      => Transient_Cache::class,
		'constructParams' => array( 'fallback_' ),
	),

	// Custom instance of File Cache for this class only.
	Cache_As_Dependency_A::class  => array(
		'substitutions' => array(
			Cache::class => new File_Cache( 'custom-path/' ),
		),
	),

	// Uses the fallback definition above, this has to be defined this can done
	Cache_As_Dependency_B::class  => array(
		'substitutions' => array(
			Cache::class => File_Cache::class,
		),
	),

	// Create a shared dependency for Transient Cache.
	'$transientCache'             => array(
		'instanceOf'      => Transient_Cache::class,
		'constructParams' => array( 'shared_' ),
	),

	// Create with the shared Transient Cache.
	// This can be used on multiple instances.
	Cache_As_Dependency_C::class  => array(
		'substitutions' => array(
			Cache::class => array( \Dice\Dice::INSTANCE => '$transientCache' ),
		),
	),

	// Uses the fallback Transient cache details
	Cache_As_Dependency_D::class  => array(
		'substitutions' => array(
			Cache::class => Transient_Cache::class,
		),
	),

	## ** Fluent Method Call Examples ** ##

	// Define the default/fallback values.
	Fluent_Dependency::class      => array(
		'call' => array(
			array( 'set_1', array( 'Default' ), Dice::CHAIN_CALL ),
			array( 'set_2', array( 'Fallback' ), Dice::CHAIN_CALL ),
			array( 'set_3', array( 'Values' ), Dice::CHAIN_CALL ),
		),
	),

	// Define rules for the dependency used on the hot swapped instance of fluent dependency
	// This is a dependency of a child {parent -> child -> fluent dep}.
	'$hot_swapped_fluent'         => array(
		'instanceOf' => Fluent_Dependency::class,
		'call'       => array(
			array( 'set_1', array( 'Hot' ), Dice::CHAIN_CALL ),
			array( 'set_2', array( 'Swapped' ), Dice::CHAIN_CALL ),
			array( 'set_3', array( 'Values' ), Dice::CHAIN_CALL ),
		),
	),

	// Custom rule for using a custom child instance in the parent service
	'$parent_with_swapped_child'  => array(
		'instanceOf'      => Parent_Service::class,
		'constructParams' => array(
			array( \Dice\Dice::INSTANCE => Hot_Swapped_Child::class ),
		),
	),

	// Whenever the hot swapped child service is used, ensure we call the custom
	// fluent dependency.
	Hot_Swapped_Child::class      => array(
		'substitutions' => array(
			Fluent_Dependency::class => '$hot_swapped_fluent',
		),
	),

	// Set rule for hot swapped child to use the custom fluent dependency.
	Parent_As_Dependency_B::class => array(
		'substitutions' => array(
			Parent_Service::class => '$parent_with_swapped_child',
		),
	),


);


// Boot a bare bones version of perique
$app = ( new App_Factory() )
	->with_wp_dice()
	->registration_classes(
		array(
			Menu_Pages::class, // Registers the menu page.
		)
	)
	->di_rules( $dependencies )
	->boot();
