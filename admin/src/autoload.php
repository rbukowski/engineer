<?php

declare(strict_types=1);

define('APP_DIRECTORY', realpath(__DIR__ . '/../..'));
define('TEMPLATES_PATH', realpath(APP_DIRECTORY . '/template'));
define('JS_ASSETS_PATH', '/js');
define('IMG_ASSETS_PATH', '/img');
define('CSS_ASSETS_PATH', '/css');

// Functions
require_once __DIR__ . '/asset-functions.php';
require_once __DIR__ . '/view-functions.php';

// Classes
require_once __DIR__ . '/AuthorizationChecker.php';
require_once __DIR__ . '/DashboardService.php';
require_once __DIR__ . '/DictionaryService.php';
require_once __DIR__ . '/FilterService.php';
require_once __DIR__ . '/PDOBuilder.php';
require_once __DIR__ . '/ResponseEmitter.php';
require_once __DIR__ . '/SearchService.php';
require_once __DIR__ . '/TypesDecoder.php';
