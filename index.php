<?php

/**
 * Part of the Cliprz framework
 *
 * @package    Cliprz
 * @author     Yousef Ismaeil <cliprz@gmail.com>
 * @copyright  Copyright (c) 2013 - 2014, Cliprz Developers team
 * @license    MIT
 * @link       http://www.cliprz.org
 * @version    1.0.0
 */

// Check PHP version is 5.4.0
if (version_compare(phpversion(),'5.4.0', "<"))
    exit('Please upgrade to PHP 5.4.0 or newer');

// Returns canonicalized absolute pathname and parent directory's path
defined('BASEPATH') or define('BASEPATH',realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Set Bootstrap file path
$__bootstrapPath = BASEPATH.'libraries'.DIRECTORY_SEPARATOR
    .'Cliprz'.DIRECTORY_SEPARATOR.'Bootstrap.php';

// Call the bootstrap our exit project if not exists
if (!file_exists($__bootstrapPath))
    exit('Cannot startup Cliprz framework.');

// Call bootstrap
require_once ($__bootstrapPath);

?>