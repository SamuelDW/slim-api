<?php

declare(strict_types=1);

namespace App\Profiles;

use App\Matcher\MatchRepository;
use App\User\UserRepository;
use App\Profiles\ProfileRepository;
use App\User\Success;
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
            $response->getBody()->write('User not found');
            return $response->withHeader('Content-Type', 'application/json');
        }

        $queryParams = $request->getQueryParams();

        if (!$queryParams) {
            $profiles = $profileRepository->getAllProfiles($user[0]['id']);

            $success = Success::createSuccessResponse($profiles, $request->getMethod(), $request->getUri());
            $response->getBody()->write(json_encode($success));
            return $response->withHeader('Content-Type', 'application/json');
        }

        if ($queryParams['age'] && $queryParams['gender']) {
            $profiles = $profileRepository->getUsersByGenderAndAge($queryParams['age'], $queryParams['gender'], $user[0]['id']);
            $success = Success::createSuccessResponse($profiles, $request->getMethod(), $request->getUri());
            $response->getBody()->write(json_encode($success));
            return $response->withHeader('Content-Type', 'application/json');
        }

        if ($queryParams['age']) {
            $profiles = $profileRepository->getUsersWithAge($queryParams['age'], $user[0]['id']);
            $success = Success::createSuccessResponse($profiles, $request->getMethod(), $request->getUri());
            $response->getBody()->write(json_encode($success));
            return $response->withHeader('Content-Type', 'application/json');
        }

        if ($queryParams['gender']) {
            $profiles = $profileRepository->getUsersByGender($queryParams['gender'], $user[0]['id']);
            $success = Success::createSuccessResponse($profiles, $request->getMethod(), $request->getUri());
            $response->getBody()->write(json_encode($success));

            return $response->withHeader('Content-Type', 'application/json');
        }

        if ($queryParams['attractiveness']) {
            $profiles = $profileRepository->getUsersByAttractiveness($queryParams['attractiveness'], $user[0]['id']);
            $success = Success::createSuccessResponse($profiles, $request->getMethod(), $request->getUri());
            $response->getBody()->write(json_encode($success));

            return $response->withHeader('Content-Type', 'application/json');
        }

        $location = $queryParams['location'] !== '' ? $queryParams['location'] : null;

        $response->getBody()->write(json_encode($queryParams));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
