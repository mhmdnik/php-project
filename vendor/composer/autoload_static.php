<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce13b99d601a6359f2a894f5bc46093a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce13b99d601a6359f2a894f5bc46093a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce13b99d601a6359f2a894f5bc46093a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitce13b99d601a6359f2a894f5bc46093a::$classMap;

        }, null, ClassLoader::class);
    }
}
