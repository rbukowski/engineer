<?php

declare(strict_types=1);

class ResponseEmitter
{
    public static function emit(array $body, int $responseCode = 200): void
    {
        http_response_code($responseCode);
        echo json_encode($body);
        exit(0);
    }
}
