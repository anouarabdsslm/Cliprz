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

use Cliprz\HTTP\URI;
use Cliprz\Router\Exceptions\ProcessorException;
use Cliprz\HTTP\Exceptions\CannotAccessToTheRequest;

class FreeRouter implements RouterInterface {

    /**
     *
     *
     * @var array
     * @access private
     */
    private $map = [];

    /**
     * Routing rules
     *
     * @var array
     * @access private
     */
    private $rules = [];

    /**
     * Regular expression mask to access routing and parameters
     *
     * @var array
     * @access private
     */
    private $mask = [
        ':ANY'    => '(.*)',
        ':INT'    => '[0-9]+',
        #':FLO'    => '[0-9]+.+[0-9]+',
        ':STR'    => '[a-z0-9-_]+',
        ':CHR'    => '[a-z]+',
        ':ACTION' => '(index|show|view|add|create|edit|update|remove|delete)',
        ':BOOL'   => '(true|false|0|1)'
    ];

    /**
     * The index page of Controllers
     * if function not exists the default function will be ControllerName::index()
     *
     * @var string
     * @access private
     */
    private $defaultFunction = 'index';

    /**
     * requested URI that sent by the Client
     *
     * @var object
     * @access private
     */
    private $URI;

    /**
     * __CLASS__ constructor
     *
     * @access public
     */
    public function __construct () {
        try {
            $this->URI = new URI();
        } catch (CannotAccessToTheRequest $e) {
            exit($e->getMessage());
        }
        $this->map = $this->map($this->URI->requestURI());
    }

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
    public function rule ($options) {
        $this->rules[] = [
            // Regular expressions
            'regex'       => (isset($options['regex']))
                ? $options['regex'] : false,
            // Class name (Controller)
            'class'       => (isset($options['class']))
                ? $options['class'] : false,
            // Metohd name (function)
            'function'    => (isset($options['function']))
                ? $options['function'] : $this->defaultFunction,
            // parameters as array
            'parameters'  => (isset($options['parameters']))
                ? $options['parameters'] : false,
            // Set class sub folder
            'path'        => (isset($options['path']))
                ? trim($options['path'],'/').'/' : false,
            // Redirecting to page of your choice if Regular expressions matched
            'redirect'    => (isset($options['redirect']))
                ? $options['redirect'] : false,
            // Request method type
            'type'        => (isset($options['type']))
                ? mb_strtoupper($options['type']) : 'GET'
        ];
    }

    /**
     * Processing router
     *
     * @access public
     */
    public function processor () {
        // Is processing router matched rules
        $isMatched = false;
        // Loop the rules
        foreach ($this->rules as $rule) {
            if (preg_match($this->resourceToRegex($rule['regex']),$this->URI->requestURI())) {
                $isMatched = true;
                // If request method equal rule type
                if ($rule['type'] == $_SERVER["REQUEST_METHOD"]) {
                    // If rule use redirect go to redirecting page
                    if (false != $rule['redirect']) {
                        $this->redirect($rule['redirect']);
                    } else {
                        // Set controller path
                        $controllerPath = (false != $rule['path']) ? $rule['path'] : '';
                        // Set controller file path
                        $controllerFile = APPPATH.'Controllers/'.$rule['path'].$rule['class'].'.php';
                        // if class file is exists
                        if (is_file($controllerFile)) {
                            // Call the class file
                            include ($controllerFile);
                            // if class (controller) exists
                            if (class_exists($rule['class'])) {
                                // Create the object
                                $class = new $rule['class'];
                                // if method exists
                                if (method_exists($rule['class'],$rule['function'])) {
                                    // if parameters is array
                                    if (false != $rule['parameters'] && is_array($rule['parameters'])) {
                                    // Call object and method and set parameters for method
                                        call_user_func_array(
                                            array($class,$rule['function']),
                                            $this->getParameters($rule['parameters']));
                                    // Else if parameters is not array
                                    } else {
                                        $class->$rule['function']();
                                    }
                                } else {
                                    throw new ProcessorException($rule['class'].'::'.$rule['function'].'() method not exists.');
                                }
                            } else {
                                throw new ProcessorException($rule['class'].' class is Invalid controller name.');
                            }
                        } else {
                            throw new ProcessorException($rule['class'].'.php not exists in Controllers.');
                        }
                    }
                } else {
                    throw new ProcessorException($rule['type'].' Invalid request method for this rule.');
                }
                // If is matched break the loop
                break;
            }
        }

        if (!$isMatched) {
            exit('<h1>404</h1>');
        }
    }


    /**
     * Set a Index page (homepage)
     *
     * @param string home page name
     * @access public
     */
    public function index ($index) {
        if ($this->URI->requestURI() == '/' || $this->URI->requestURI() == '') {
            $this->redirect($index);
        }
    }

    /**
     * Convert requested URI that sent by the Client to regular expression
     *
     * @param string Requested URI that sent by the Client
     * @access private
     */
    private function resourceToRegex ($resource) {
        $replace = str_ireplace(array_keys($this->mask),$this->mask,$resource);
        $regex   = "`^{$replace}$`i";
        return (string) $regex;
    }

    /**
     * Convert requested URI that sent by the Client to array
     *
     * @param string Requested URI that sent by the Client
     * @access private
     */
    private function map ($map) {
        return ((array) explode("/",$map));
    }

    /**
     * Find and set parameters if exsists
     *
     * @param array parameters
     * @access private
     */
    private function setParameters (Array $parameters) {
        foreach ($parameters as $param) {
            $result[] = $this->map[$param];
        }
        return $result;
    }

    /**
     * Get parameters if exsists
     *
     * @param array Method (function) parameters
     * @access private
     */
    private function getParameters (Array $parameters) {
        return $this->setParameters($parameters);
    }

    /**
     * Redirecting
     *
     * @param string Redirecting page as default null index.php
     * @access public
     */
    public function redirect ($page=null) {
        header("HTTP/1.1 301 Moved Permanently");
        if (is_null($page)) {
            header("Location: index.php");
        } else {
            header("Location: ".$page);
        }
        exit();
    }

}

?>