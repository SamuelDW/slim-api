<?php

declare(strict_types=1);

namespace App\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\User\MissingFieldsError;
use \App\User\User;

class CreateUserAction
{
    private const NUMBER_OF_USER_FIELDS = 5;

    /**
     * Creating the user from the request data
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $userData = $request->getParsedBody();
        $errors = [];
        if (count($userData) === 0 || count($userData) < self::NUMBER_OF_USER_FIELDS) {
            $errors['Invalid Data'] = 'You are missing data. There should be name, email, age, gender and password';
        }

        if ($userData['age'] < 18) {
            $errors['Age Limit'] = 'You must be aged 18 or older to create a profile';
        }

        if (count($errors) > 0) {
            $errorResponse = MissingFieldsError::createErrorResponse(
                $errors,
                $request->getMethod(),
                $userData,
                'Errors Present in Data'
            );
            $response->getBody()->write(json_encode($errorResponse));

            return $response->withHeader('Content-Type', 'application/json');
        }

        $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user = new User($userData['name'], $userData['email'], $hashedPassword, $userData['gender'], $userData['age']);

        $userRepository = new UserRepository();
        $userRepository->createUser($user);

        return $response->withHeader('Content-Type', 'application/json');
    }
}
