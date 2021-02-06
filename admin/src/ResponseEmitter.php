<?php

declare(strict_types=1);

class ResponseEmitter
{
    public static function emit(array $body, int $responseCode = 200): void
    {
        $encodedBody = json_encode($body);

        ob_clean();
        http_response_code($responseCode);

        header('Content-Type: application/json');
        header('Content-Length: ' . strlen($encodedBody));
        header('Cache-Control: no-cache');

        echo $encodedBody;

        exit(0);
    }
}
