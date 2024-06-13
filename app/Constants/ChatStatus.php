<?php

namespace App\Constants;

use ReflectionClass;
use Illuminate\Support\Collection;

class ChatStatus
{
    public const OPEN = 'Open';
    public const CLOSED = 'Closed';

    public static function all(): Collection
    {
        $class = new ReflectionClass(__CLASS__);
        return collect($class->getConstants());
    }
}