<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2c1612ff2bb8d3c484a6843831fa0cc3
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Slim\\' => 5,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'I' => 
        array (
            'Interop\\Container\\' => 18,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Slim\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/slim/Slim',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Interop\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/container-interop/container-interop/src/Interop/Container',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'V' => 
        array (
            'Viocon' => 
            array (
                0 => __DIR__ . '/..' . '/usmanhalalit/viocon/src',
            ),
        ),
        'P' => 
        array (
            'Pixie' => 
            array (
                0 => __DIR__ . '/..' . '/usmanhalalit/pixie/src',
            ),
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2c1612ff2bb8d3c484a6843831fa0cc3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2c1612ff2bb8d3c484a6843831fa0cc3::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit2c1612ff2bb8d3c484a6843831fa0cc3::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
