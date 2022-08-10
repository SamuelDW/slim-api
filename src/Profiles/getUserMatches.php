<?php

declare(strict_types=1);

namespace App\Profiles;

use App\User\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class getUserMatches
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $userId = $args['id'];
        $userRepository = new UserRepository();
        $user = $userRepository->findUserById($userId);
        if (!$user) {

        }

        $queryParams = $request->getQueryParams();
        if ($queryParams) {

        }

        $response->getBody()->write(json_encode($user));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
