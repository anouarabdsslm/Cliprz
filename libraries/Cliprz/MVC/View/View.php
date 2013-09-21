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

namespace Cliprz\MVC\View;

class View {

    /**
     * Display a file from Views
     *
     * @param string filename, if path exists put it, don't use .php suffix
     * @param array  indexes data
     * @access public
     */
    public static function display ($filename,$data=null) {
        $pathToViewFile = APPPATH.'Views/'.trim($filename,'/').'.php';
        if (is_file($pathToViewFile)) {
            if (is_array($data)) {
                extract($data);
            }
            include ($pathToViewFile);
        } else {
            throw new \Exception($pathToViewFile.' not exists.');
        }
    }

}

?>