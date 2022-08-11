<?php

declare(strict_types=1);

namespace App\Profiles;

use App\Matcher\MatchRepository;
use App\User\UserRepository;
use App\Profiles\ProfileRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class getUserMatches
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $userId = $args['id'];
        $userRepository = new UserRepository();
        $profileRepository = new ProfileRepository();
        $user = $userRepository->findUserById($userId);

        if (!$user) {

        }

        $queryParams = $request->getQueryParams();
        if (!$queryParams) {
            $profiles = $profileRepository->getAllProfiles($user[0]['id']);

            $response->getBody()->write(json_encode($profiles));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $age = $queryParams['age'];
        $ageRange = $queryParams['age_range'];
        $attractiveness = $queryParams['attractiveness'];
        $location = $queryParams['location'] !== '' ? $queryParams['location'] : null;

        $response->getBody()->write(json_encode($queryParams));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
