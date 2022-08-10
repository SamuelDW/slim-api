<?php

declare(strict_types=1);

namespace App\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteUserAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $userId = $request->getAttribute('id');
        $userExists = UserRepository::doesUserExist($userId);
        if (!$userExists) {
            return '';
        }

        UserRepository::deleteUser($userId);
    }
}
