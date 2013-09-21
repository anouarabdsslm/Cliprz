<?php

use Cliprz\Router\Router;

Router::index('welcome');

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