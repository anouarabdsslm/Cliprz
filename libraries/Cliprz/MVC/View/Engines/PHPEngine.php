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

namespace Cliprz\MVC\View\Engines;

use Cliprz\MVC\View\Engines\Exceptions\InvalidViewFileName;

class PHPEngine implements EngineInterface {

    /**
     * File suffix
     *
     * @access private
     */
    private $suffix = '.php';

    /**
     * Get view file
     *
     * @param string  file name with directory if exists
     * @param array   data as indexes array
     * @access public
     */
    public function getFile ($filename,$data=false) {
        $file = $filename.$this->suffix;
        if (is_file($file)) {
            if (is_array($data)) {
                extract($data);
            }
            ob_start();
            include ($file);
            $contents = ob_get_contents();
            ob_end_clean();
            echo $contents;
        } else {
            throw new InvalidViewFileName('Invalid view file '.$file);
        }
    }

}

?>