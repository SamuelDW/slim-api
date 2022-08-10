<?php

declare(strict_types=1);

use App\Auth\AuthenticateUser;
use App\User\CreateUserAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/user', function (RouteCollectorProxy $group) {
        $group->post('/create', CreateUserAction::class);

        //$group->post('/gallery', CreateUserAction::class);

        // $group->delete('/delete', DeleteUserAction::class);
    });

    $app->post('/login', AuthenticateUser::class);

    // $app->get('/profiles/{id:[0-9]+', CreateUserAction::class);

    // $app->get('/swipe', CreateUserAction::class);
};

