<?php

declare(strict_types=1);

class ResponseEmitter
{
    public const OK = 200;
    public const UNAUTHORIZED = 401;
    public const INTERNAL_SERVER_ERROR = 500;

    public static function errorView(
        int $responseCode = self::INTERNAL_SERVER_ERROR,
        ?string $errorMessage = null
    ): void {
        self::view(
            TEMPLATES_PATH . '/error.php',
            [
                'errorMessage' => $errorMessage,
                'errorCode' => $responseCode,
            ],
            $responseCode
        );
    }

    public static function view(
        string $viewPath,
        array $viewVariables = [],
        int $responseCode = self::OK
    ): void {
        ob_clean();

        http_response_code($responseCode);
        header('Content-Type: text/html; charset=UTF-8');

        // Wywołujemy wszystkie przekazane zmienne, aby mógł z nich skorzystać renderowany widok.
        foreach ($viewVariables as $viewVariable => $variableValue) {
            ${$viewVariable} = $variableValue;
        }

        require_once $viewPath;
        self::shutdown();
    }

    public static function emit(array $body, int $responseCode = self::OK): void
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
