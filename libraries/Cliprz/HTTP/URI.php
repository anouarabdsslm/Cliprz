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

namespace Cliprz\HTTP;

use Cliprz\HTTP\Exceptions\CannotAccessToTheRequest;

class URI {

    /**
     * __CLASS__ constructor
     *
     * @access public
     */
    public function __construct () {
        if (!isset($_SERVER['REQUEST_URI']) || !isset($_SERVER['SCRIPT_NAME'])) {
            throw new CannotAccessToTheRequest('REQUEST_URI or SCRIPT_NAME cannot access to the request.');
        }
    }

    /**
     * Detects the Request URI
     *
     * @access private
     */
    public function requestURI () {
        // set request URI
        $requestURI = $_SERVER['REQUEST_URI'];
        // If SCTIPT_NAME exsits in REQUEST_METHOD
        if (strpos($requestURI,$_SERVER['SCRIPT_NAME']) === 0) {
            $requestURI = mb_substr($requestURI,mb_strlen($_SERVER['SCRIPT_NAME']));
        } else if (strpos($requestURI,dirname($_SERVER['SCRIPT_NAME'])) === 0) {
            $requestURI = mb_substr($requestURI,mb_strlen(dirname($_SERVER['SCRIPT_NAME'])));
        }
        /** fix query string */
        $requestURI = $this->fixQueryString($requestURI);
        /** if request URI equal / or empty return to null value */
        if ($requestURI == '/' || empty($requestURI)) {
            return '/';
        }
        /** parse url */
        $requestURI = parse_url($requestURI,PHP_URL_PATH);
        /** fix slashes */
        $requestURI = str_replace(['//','../','\\'],'/',$requestURI);
        $requestURI = trim($requestURI,'/');
        return (string) $requestURI;
    }

    /**
     * Fix the query string
     *
     * @param string request URI
     * @access public
     */
    private function fixQueryString($requestURI) {
        if (strncmp($requestURI,'?/', 2) === 0) {
            $requestURI = mb_substr($requestURI,2);
        }

        $parts = preg_split('`\?`i',$requestURI,2);

        $requestURI = $parts[0];

        if (isset($parts[1])) {
            $_SERVER['QUERY_STRING'] = $parts[1];
            parse_str($_SERVER['QUERY_STRING'],$_GET);
        } else {
            $_SERVER['QUERY_STRING'] = '';
            $_GET = [];
        }
        return $requestURI;
    }

}

?>