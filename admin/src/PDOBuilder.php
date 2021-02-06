<?php

declare(strict_types=1);

class PDOBuilder
{
    private static $instance;

    /**
     * Taka konstrukcja jest po to, aby nie otwierać kilku połączeń do bazy danych tylko zawsze zwracać to samo.
     */
    public static function getInstance(): PDO
    {
        if (!self::$instance instanceof PDO) {
            self::createInstance();
        }

        return self::$instance;
    }

    private static function createInstance(): void
    {
        if (!file_exists(__DIR__ . '/config/database.php')) {
            throw new RuntimeException(
                'Plik konfiguracji dostępów do bazy danych nie istnieje!'
                    . ' Utwórz plik konfiguracji na bazie pliku "config/database.dist.php".'
            );
        }

        $config = require_once __DIR__ . '/config/database.php';

        self::$instance = new PDO(
            sprintf(
                'pgsql:host=%s;port=%s;dbname=%s;user=%s;password=%s',
                $config['host'],
                $config['port'],
                $config['dbname'],
                $config['user'],
                $config['password']
            ),
        );
    }
}

