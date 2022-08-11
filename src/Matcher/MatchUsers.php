<?php

declare(strict_types=1);

namespace App\Matcher;

use App\Matcher\MatchRepository;
use App\User\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class MatchUsers
{
    public function __invoke(Request $request, Response $response): Response
    {
        $matchData = $request->getParsedBody();
        $user = $matchData['user_id'];
        $match = $matchData['match_id'];
        $swipeDirection = $matchData['swipe_direction'];

        $matchRepository = new MatchRepository();
        $matches = $matchRepository->doesMatchExist($user, $match);

        if (!$matches) {
            $match = $matchRepository->createMatch($user, $match, $swipeDirection);
            $matchRepository->updateUserStatistics($match, $swipeDirection);

            $response->getBody()->write(json_encode($matches));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $matchRepository->updateMatch($user, $match, $swipeDirection, $match);
        $matchRepository->updateUserStatistics($match, $swipeDirection);

        $newMatch = $matchRepository->doesMatchExist($user, $match);
        if ($newMatch[0]['match_swipe'] === "YES" && $newMatch[0]['user_swipe'] === "YES") {
            $response->getBody()->write(json_encode($newMatch[0]));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write('Keep Searching!');
            return $response->withHeader('Content-Type', 'application/json');
    }
}
