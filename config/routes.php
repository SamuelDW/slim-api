<?php

declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->post('/user/create', \App\Action\CreateUserAction::class);

    $app->post('/login', \App\Action\CreateUserAction::class);

    $app->get('/profiles', \App\Action\CreateUserAction::class);

    $app->get('/swipe', \App\Action\CreateUserAction::class);

    $app->post('/user/gallery', \App\Action\CreateUserAction::class);
};

