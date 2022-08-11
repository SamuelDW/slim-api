<?php

declare(strict_types=1);

namespace App\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UploadedFileInterface;

class UploadUserPhotos
{
    /**
     * Allowing the user to upload photos
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $files = $request->getUploadedFiles();
        $directory = '../../../uploads';
        foreach ($files['newfile'] as $file) {
            if ($file->getError() === UPLOAD_ERR_OK) {
                $filename = moveUploadedFile($directory, $file);
                $response->getBody()->write('Uploaded: ' . $filename . '<br>');

            }
        }
        return $response->withHeader('Content-Type', 'application/json');
    }
}
