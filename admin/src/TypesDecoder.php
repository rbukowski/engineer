<?php

declare(strict_types=1);

class TypesDecoder
{
    public static function decodeFromJson(string $json): array
    {
        $types = [];

        foreach (json_decode($json, true) as $type) {
            $types[$type['id']] = $type['type'];
        }

        return $types;
    }
}
