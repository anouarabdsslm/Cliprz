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

return [
    // HTTP classes and interfaces
    'Cliprz\\HTTP\\Exceptions\\CannotAccessToTheRequest'          => CLIPRZPATH.'HTTP/Exceptions/CannotAccessToTheRequest.php',
    'Cliprz\\HTTP\\URI'                                           => CLIPRZPATH.'HTTP/URI.php',
    'Cliprz\\HTTP\\Request'                                       => CLIPRZPATH.'HTTP/Request.php',

    // Router classes and interfaces
    'Cliprz\\Router\\Exceptions\\InvalidRoutingType'              => CLIPRZPATH.'Router/Exceptions/InvalidRoutingType.php',
    'Cliprz\\Router\\Exceptions\\ProcessorException'              => CLIPRZPATH.'Router/Exceptions/ProcessorException.php',
    'Cliprz\\Router\\RouterInterface'                             => CLIPRZPATH.'Router/RouterInterface.php',
    'Cliprz\\Router\\RouterFactory'                               => CLIPRZPATH.'Router/RouterFactory.php',
    'Cliprz\\Router\\Router'                                      => CLIPRZPATH.'Router/Router.php',
    'Cliprz\\Router\\FreeRouter'                                  => CLIPRZPATH.'Router/FreeRouter.php',

    // View Engines classes and interfaces
    'Cliprz\\MVC\\View\\Engines\\Exceptions\\InvalidViewFileName' => CLIPRZPATH.'MVC/View/Engines/Exceptions/InvalidViewFileName.php',
    'Cliprz\\MVC\\View\\Engines\\EngineInterface'                 => CLIPRZPATH.'MVC/View/Engines/EngineInterface.php',
    'Cliprz\\MVC\\View\\Engines\\PHPEngine'                       => CLIPRZPATH.'MVC/View/Engines/PHPEngine.php',
    'Cliprz\\MVC\\View\\Engines\\TemplateEngine'                  => CLIPRZPATH.'MVC/View/Engines/TemplateEngine.php',

    // View classes and interfaces
    'Cliprz\\MVC\\View\\View'                                     => CLIPRZPATH.'MVC/View/View.php',
];

?>