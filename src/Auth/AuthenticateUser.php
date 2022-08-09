<?php

declare(strict_types=1);

namespace App\Auth;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class AuthenticateUser
{
    public function __invoke(Request $request, Response $response): Response
    {
        $userData = $request->getParsedBody();
        if (!$userData['email'] || !$userData['password']) {
            $payload = json_encode(['errors' => [
                'error' => 'No Username or Password provided'
            ]]);
        }
        $userExists = true;
        // check if the email exists
        // if email exists does hashed password match
        $userCorrectlyAuthenticated = true;
        if ($userExists && $userCorrectlyAuthenticated) {
            return $response->withHeader('Content-Type', 'application/json');
        }
    }
}
