<?php

$dir = __DIR__ . '/app';

$iterator = Symfony\Component\Finder\Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('build')
    ->exclude('tests')
    ->in($dir);

$options = [
    'theme'                => 'default',
    'title'                => 'Simpligps PHP Documentation',
    'build_dir'            => __DIR__ . '/storage/app/public/docs/php',
    'cache_dir'            => __DIR__ . '/storage/app/public/docs/php',
];
//5,260.92
return new Sami\Sami($iterator, $options);
