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

use Cliprz\Router\Exceptions\InvalidRoutingType;

class RouterFactory {

    /**
     * Routing types
     *
     * @var array
     * @access private
     */
    private $list;

    /**
     * __CLASS__ constructor
     *
     * @access public
     */
    public function __construct () {
        $this->list = [
            #'STANDARD' => __NAMESPACE__.'\\StandardRouter',
            'FREE'     => __NAMESPACE__.'\\FreeRouter'
        ];
    }

    /**
     * Create routing object
     *
     * @access public
     */
    public function create ($factory) {
        $factory = mb_strtoupper($factory);
        if (!array_key_exists($factory,$this->list)) {
            throw new InvalidRoutingType($factory.' is invalid routing type.');
        }
        return new $this->list[$factory]();
    }

}

?>