<?php

declare(strict_types=1);

function implode_newline (array $array): string {
    return implode(
        '<br>',
        $array
    );
}

function json_decode_array (string $json): array {
    return json_decode($json, true);
}

function decode_multiline (string $json): string {
    return implode_newline(
        json_decode_array($json)
    );
}
