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

namespace Cliprz\Router;

interface RouterInterface {

    /**
     * Add new rule to routing
     *
     * @param array Rule options as array with keys
     *               string 'regex'       URL mask you want to use
     *               string 'class'       Controller class name
     *               string 'function'    Controller class method (function), By default take self::$default_function value
     *               string 'parameters'  Controller class method (function) parameters as array with position number beginning from zero
     *               string 'path'        If controller class in subfolder inside controllers folder, put the path name here
     *               string 'redirect'    Redirecting page of your choice if Regular expressions matched
     *               string 'type'        Request method to access routing, By default GET u can use (POST|GET|HEAD|PUT)
     * @access public
     */
    public function rule ($options);

    /**
     * Processing router
     *
     * @access public
     */
    public function processor ();

    /**
     * Set a Index page (homepage)
     *
     * @param string home page name
     * @access public
     */
    public function index ($index);

}

?>