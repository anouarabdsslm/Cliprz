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

interface EngineInterface {

    /**
     * Get view file
     *
     * @param string  file name with directory if exists
     * @param array   data as indexes array
     * @access public
     */
    public function getFile ($filename,$data);

}

?>