<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcdce8aa3b8cc69376544ec22f5346c67
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WebAtrio\\PDFToImage\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WebAtrio\\PDFToImage\\' => 
        array (
            0 => __DIR__ . '/..' . '/web-atrio/php-pdf-to-image',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcdce8aa3b8cc69376544ec22f5346c67::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcdce8aa3b8cc69376544ec22f5346c67::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}