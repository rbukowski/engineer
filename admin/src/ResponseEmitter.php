<?php

declare(strict_types=1);

class ResponseEmitter
{
    public static function emit(array $body, int $responseCode = 200): void
    {
        $encodedBody = json_encode($body);

        ob_clean();

        if (json_last_error()) {
            http_response_code(500);
            header('Content-Type: text/html; charset=UTF-8');

            self::shutdown('Nie udało się zakodować odpowiedzi: ' . json_last_error_msg() . PHP_EOL);
        }

        http_response_code($responseCode);

        header('Content-Type: application/json');
        header('Content-Length: ' . strlen($encodedBody));
        header('Cache-Control: no-cache');

        self::shutdown($encodedBody);
    }

    private static function shutdown(?string $output = null): void
    {
        echo $output;
        exit;
    }
}
