<?php

declare(strict_types=1);

namespace App\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteUserAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $userData = $request->getParsedBody();
        $userRepository = new UserRepository();
        $userExists = $userRepository->findUserByEmail($userData['email']);
        if (!$userExists) {
            return '';
        }

        $userRepository->deleteUser($userExists['id']);

        $response->getBody()->write('');
        return $response->withHeader('Content-Type', 'application/json');
    }
}
