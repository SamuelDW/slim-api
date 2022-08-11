<?php

declare(strict_types=1);

use App\Auth\AuthenticateUser;
use App\Matcher\MatchUsers;
use App\Profiles\getUserMatches;
use App\User\CreateUserAction;
use App\User\DeleteUserAction;
use App\User\UploadUserPhotos;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/user', function (RouteCollectorProxy $group) {
        $group->post('/create', CreateUserAction::class);

        // Add Auth Middleware
        $group->post('/gallery', UploadUserPhotos::class);

        // Add Auth Middleware
        $group->delete('/delete/{id:[0-9]+}', DeleteUserAction::class);
    });

    $app->post('/login', AuthenticateUser::class);

    // Add auth middleware
    $app->get('/profiles/{id:[0-9]+}', getUserMatches::class);

    // Add auth middleware
    $app->post('/swipe', MatchUsers::class);
};

