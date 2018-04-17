<?php

return [
    'routes' => [
        '/' => Controller\Home::class,
        '/login' => Controller\Login::class,
        '/detail' => Controller\Detail::class,
        '/logout' => Controller\Logout::class,
        '/impressum' => Controller\Impressum::class,
        '/eintrag' => Controller\AddEntrie::class,
        '/addComment' => Controller\AddComment::class
    ],
    'factories' => [
        // todo: framework und projekt configs voneinander trennen
        \Repository\Comment::class => \Factory\Comment::class,
        \Repository\Entry::class => \Factory\Entry::class,
        \Repository\Comment::class => \Factory\Comment::class,
        \PDO::class => Factory\PdoFactory::class,
        \Controller\Home::class => \Factory\Controller::class,
    ]
];

// todo config erweitern für di-configuration