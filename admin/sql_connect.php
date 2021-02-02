<?php
    declare(strict_types=1);

    class PDOBuilder
    {
        private static $instance;
        private static $host = "127.0.0.1";
        private static $user = 'root';
        private static $password = '';
        private static $dbname = 'inz';

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
            self::$instance = new PDO(
                sprintf(
                    'mysql:host=%s;dbname=%s',
                    self::$host,
                    self::$dbname,
                ),
                self::$user,
                self::$password
            );
        }
    }

    return PDOBuilder::getInstance();
?>