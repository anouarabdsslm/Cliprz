<?php

/**
 * Routing URLs file
 */

// Use Router class
use Cliprz\Router\Router;

// Your home page
Router::index('welcome');

// Add a rule
Router::rule([
    'regex' => 'welcome',
    'class' => 'Welcome'
]);

Router::rule([
    'regex'      => 'test/:ANY',
    'class'      => 'welcome',
    'function'   => 'test',
    'parameters' => [1]
]);

?>