<?php

declare(strict_types=1);

namespace App\User;

final class MissingFieldsError
{
    /**
     * Returning a standard Error response
     * @param array $errors the error messages
     * @param string $method the type of request [get, post, etc]
     * @param mixed $originalData the data that was sent
     * @param mixed $message an overview of the issue
     * @return string|false
     */
    public static function createErrorResponse(array $errors, string $method, $originalData, $message)
    {
        return [
            'apiVersion' => '1.0.0',
            'method' => $method,
            'params' => $originalData,
            'error' => [
                'code' => 400,
                'message' => $message,
                'errors' => $errors
            ]
        ];
    }
}
