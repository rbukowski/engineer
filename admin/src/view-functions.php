<?php

declare(strict_types=1);

function implode_newline (array $array): string {
    return implode(
        '<br>',
        $array
    );
}
