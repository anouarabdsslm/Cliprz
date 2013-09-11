<?php

/**
 * Cliprz framework
 *
 * An open source application development framework for PHP 5.4.0 or newer
 *
 * @package    Cliprz
 * @author     Yousef Ismaeil <cliprz@gmail.com>
 * @copyright  Copyright (c) 2013 - 2014, Cliprz Developers team
 * @license    MIT
 * @link       http://www.cliprz.org
 * @version    1.0.0
 */

// Use Cliprz\Loader\Autoload
use Cliprz\Loader\Autoload;

// Set the core path to classes
Autoload::setCore(CLIPRZPATH);

// Set the fallback paths
Autoload::setFallback([
    APPPATH.'Includes'
]);

// Load our maps
$__ourMap = [
    'classes'    => include (CLIPRZPATH.'Loader/Maps/Classes.php'),
    'namespaces' => include (CLIPRZPATH.'Loader/Maps/Namespaces.php')
];

Autoload::addMaps($__ourMap['classes']);
Autoload::addMaps($__ourMap['namespaces']);

?>