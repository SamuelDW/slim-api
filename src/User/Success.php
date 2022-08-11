<?php

declare(strict_types=1);

namespace App\User;

final class Success
{
    public static function createSuccessResponse(array $data, string $method, $originalData)
    {
        return [
            'apiVersion' => '1.0.0',
            'method' => $method,
            'params' => $originalData,
            'data' => $data,
        ];
    }
}
