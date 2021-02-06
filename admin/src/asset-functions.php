<?php

declare(strict_types=1);

function asset_css(string $assetPath): void {
    $cssPath = get_path(CSS_ASSETS_PATH . DIRECTORY_SEPARATOR . $assetPath);

    echo "<link rel=\"stylesheet\" href=\"$cssPath\">";
}

function asset_js(string $assetPath): void {
    $jsPath = get_path(JS_ASSETS_PATH . DIRECTORY_SEPARATOR . $assetPath);

    echo "<script src=\"$jsPath\"></script>";
}

function asset_img(string $assetPath): void {
    echo get_path(IMG_ASSETS_PATH . DIRECTORY_SEPARATOR . $assetPath);
}

function get_path(string $assetPath): string {
    $appConfig = require_once __DIR__ . '/config/app.php';

    if (!empty($appConfig['projectPath'])) {
        return "{$appConfig['projectPath']}/$assetPath";
    }

    return $assetPath;
}
