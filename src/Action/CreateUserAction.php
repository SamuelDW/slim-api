<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class CreateUserAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $userData = $request->getParsedBody();
        $payload = json_encode(['data' => $userData]);

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}
