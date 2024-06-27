<?php

namespace App\Constants;

use ReflectionClass;
use Illuminate\Support\Collection;

class FeatureStatus
{
    public const ACTIVE = 'Aktif';
    public const INACTIVE = 'Tidak Aktif';

    public static function all(): Collection
    {
        $class = new ReflectionClass(__CLASS__);
        return collect($class->getConstants());
    }
}