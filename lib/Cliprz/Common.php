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

namespace Cliprz;

/**
 * Prints human-readable information about a variable but with HTML <pre> tag
 *
 * @param mixed The expression to be printed
 * @see http://php.net/print_r
 */
if (!function_exists('pre_print_r')) {
    function pre_print_r ($expression) {
        echo '<pre>'; print_r($expression); echo '</pre>';
    }
}

/**
 * If Cliprz framework in beta version this function will Kill the project in real websites
 */
if (!function_exists('on_beta')) {
	function on_beta () {
		if (!in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1',))) {
			header('HTTP/1.0 403 Forbidden');
			exit('This is beta version of Cliprz framework,
				script is only accessible from localhost.');
		}
	}
}

?>