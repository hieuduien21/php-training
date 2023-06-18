<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit73c2cda830c5fd98b91db2fb13155ac5
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit73c2cda830c5fd98b91db2fb13155ac5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit73c2cda830c5fd98b91db2fb13155ac5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit73c2cda830c5fd98b91db2fb13155ac5::$classMap;

        }, null, ClassLoader::class);
    }
}
