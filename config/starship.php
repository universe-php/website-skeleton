<?php

$config = [
    'version' =>  '1.0.0',
    'theme' => 'default',
    'outputMode' => 'webApp',
    'debugMode' => false,

    'smtp' => [
        'host'=>'',
        'user'=>'',
        'password'=>'',
        'port'=>''
    ],

    'title' => 'Universe WebSite Skeleton',
    'lang' => 'en',
    'langUriPrefix' => ['en'=>'','tr'=>'tr'],

    'componentCss' => [],
    'cssBundle' => ''

];
return (object)$config;