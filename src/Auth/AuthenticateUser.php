<?php

declare(strict_types=1);

namespace App\Auth;

use App\User\MissingFieldsError;
use App\User\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class AuthenticateUser
{
    public function __invoke(Request $request, Response $response): Response
    {
        $userRepository = new UserRepository();
        $userData = $request->getParsedBody();
        if (!$userData['email'] || !$userData['password']) {
            $payload = json_encode(['errors' => [
                'error' => 'No Username or Password provided'
            ]]);
        }

        $user = $userRepository->findUserByEmail($userData['email']);
        if (!$user) {
            $errorResponse = MissingFieldsError::createErrorResponse(
                ['User Not Found. Please create a user at /user/create'],
                $request->getMethod(),
                $userData,
                'User Not Found'
            );
            $response->getBody()->write(json_encode($errorResponse));

            return $response->withHeader('Content-Type', 'application/json');
        }

        $isPasswordCorrect = password_verify($userData['password'], $user[0]['password']);
        if (!$isPasswordCorrect) {
            $errorResponse = MissingFieldsError::createErrorResponse(
                ['Email or Password does not match. Please try again'],
                $request->getMethod(),
                $userData,
                'Email or Password Incorrect'
            );
            $response->getBody()->write(json_encode($errorResponse));

            return $response->withHeader('Content-Type', 'application/json');
        }

        $isSessionExist = $userRepository->doesSessionExistAndIsNotExpired($user[0]['id']);
        if (!$isSessionExist) {
            $sessionId = session_create_id();
            $userRepository->registerSession($user[0]['id'], $sessionId);
            $_SESSION['session_id'] = $sessionId;

            $response->getBody()->write(json_encode(['Succes' => 'You are logged in']));
            return $response->withHeader('Content-Type', 'application/json');
        }

        // set the session
        $_SESSION['session_id'] = $isSessionExist[0]['session_id'];

        $response->getBody()->write(json_encode(['Succes' => 'You are logged in']));
        return $response->withHeader('Content-Type', 'application/json');

        // $userCorrectlyAuthenticated = true;
        // if ($userExists && $userCorrectlyAuthenticated) {
        //     return $response->withHeader('Content-Type', 'application/json');
        // }
    }
}
