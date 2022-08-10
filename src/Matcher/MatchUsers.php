<?php

declare(strict_types=1);

namespace App\Matcher;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class MatchUsers
{
    public function __invoke(Request $request, Response $response): Response
    {
        $matchData = $request->getParsedBody();
        $user = $matchData['my_id'];
        $match = $matchData['match_id'];
        $swipe_direction = $match['swipe_direction'];

        $response->getBody()->write(json_encode(''));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
