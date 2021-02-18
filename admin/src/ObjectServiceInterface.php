<?php

declare(strict_types=1);

interface ObjectServiceInterface
{
    public function doesExist(int $id): bool;
}
