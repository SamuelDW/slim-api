<?php

declare(strict_types=1);

namespace App\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteUserAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $userRepository = new UserRepository();
        $userExists = $userRepository->findUserById($args['id']);
        if (!$userExists) {
            return '';
        }

        $userRepository->deleteUser($args['id']);

        $response->getBody()->write(['User deleted']);
        return $response->withHeader('Content-Type', 'application/json');
    }
}
