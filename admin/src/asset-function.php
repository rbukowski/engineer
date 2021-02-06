<?php

declare(strict_types=1);

function asset_css($assetPath): void {
    $appConfig = require __DIR__ . '/config/app.php';
    $cssPath = "{$appConfig['projectPath']}/$assetPath";

    echo "<link rel=\"stylesheet\" href=\"$cssPath\">";
}

function asset_js($assetPath): void {
    $appConfig = require __DIR__ . '/config/app.php';
    $jsPath = "{$appConfig['projectPath']}/$assetPath";

    echo "<script src=\"$jsPath\"></script>";
}
