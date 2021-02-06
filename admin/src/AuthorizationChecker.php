<?php

declare(strict_types=1);

class AuthorizationChecker
{
    public static function check(): void
    {
        session_start();

        if (!isset($_SESSION['logged'])
            || $_SESSION['logged'] !== true
        ) {
            ResponseEmitter::errorView(
                ResponseEmitter::UNAUTHORIZED,
                'Brak dostępu!'
            );
        }
    }
}
