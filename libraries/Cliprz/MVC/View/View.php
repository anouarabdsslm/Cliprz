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

use Cliprz\MVC\View\Engines\PHPEngine;
use Cliprz\MVC\View\Engines\TemplateEngine;
use Cliprz\MVC\View\Engines\Exceptions\InvalidViewFileName;

class View {

    /**
     * View engine class
     *
     * @var object
     * @static
     */
    public static $engine;

    /**
     * Display a file from Views
     *
     * @param string filename, if path exists put it, don't use .php suffix
     * @param array  indexes data
     * @access public
     */
    public static function display ($filename,$data=null) {
        $prepareFile = APPPATH.'Views/'.trim($filename,'/');
        static::$engine = new PHPEngine();
        try {
            static::$engine->getFile($prepareFile,$data);
        } catch (InvalidViewFileName $e) {
            echo $e->getMessage();
        }

    }

}

?>