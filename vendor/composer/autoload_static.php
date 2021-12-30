<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8fa915b043d1a5a9848548eb817a1c20
{
    public static $files = array (
        'be8785f285476d960a9374d1a827f21a' => __DIR__ . '/..' . '/pinkcrab/hook-loader/tests/Fixtures/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Container\\' => 14,
            'PinkCrab\\Perique\\' => 17,
            'PinkCrab\\Loader\\' => 16,
        ),
        'G' => 
        array (
            'Gin0115\\Perique_Container_Example\\' => 34,
        ),
        'D' => 
        array (
            'Dice\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'PinkCrab\\Perique\\' => 
        array (
            0 => __DIR__ . '/..' . '/pinkcrab/perique-framework-core/src',
        ),
        'PinkCrab\\Loader\\' => 
        array (
            0 => __DIR__ . '/..' . '/pinkcrab/hook-loader/src',
        ),
        'Gin0115\\Perique_Container_Example\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Dice\\' => 
        array (
            0 => __DIR__ . '/..' . '/level-2/dice',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8fa915b043d1a5a9848548eb817a1c20::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8fa915b043d1a5a9848548eb817a1c20::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8fa915b043d1a5a9848548eb817a1c20::$classMap;

        }, null, ClassLoader::class);
    }
}
