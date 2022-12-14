<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc7266cc7b66e9903a496e3a63f94a121
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc7266cc7b66e9903a496e3a63f94a121::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc7266cc7b66e9903a496e3a63f94a121::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc7266cc7b66e9903a496e3a63f94a121::$classMap;

        }, null, ClassLoader::class);
    }
}
