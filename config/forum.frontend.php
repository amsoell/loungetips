<?php

return [

    'routes' => true,
    'middleware' => 'web',
    'controllers' => [
        'namespace' => 'Riari\Forum\Frontend\Http\Controllers',
        'category'  => 'CategoryController',
        'thread'    => 'ThreadController',
        'post'      => 'PostController'
    ],
    'utility_class' => Riari\Forum\Frontend\Support\Forum::class,

];
