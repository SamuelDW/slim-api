<?php

declare(strict_types=1);

namespace App\Auth;

use App\User\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class isUserAuthenticated
{
    public function __invoke(Request $request, Response $response): Response
    {
        $parsedBody = $request->getParsedBody();
        if (!$parsedBody['token']) {
            $response->getBody()->write('You do not have permission to view this resource');
            return $response->withHeader('Content-Type', 'application/json');
        }

        $userRepository = new UserRepository();
        $session = $userRepository->doesSessionExistAndIsNotExpired($parsedBody['user_id']);
    }
}
