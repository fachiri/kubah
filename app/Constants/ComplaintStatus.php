<?php

namespace App\Constants;

use ReflectionClass;
use Illuminate\Support\Collection;

class ComplaintStatus
{
    public const PENDING = 'Pending';
    public const IN_PROGRESS = 'In Progress';
    public const RESOLVED = 'Resolved';

    public static function all(): Collection
    {
        $class = new ReflectionClass(__CLASS__);
        return collect($class->getConstants());
    }
}