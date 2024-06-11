<?php

namespace App\Constants;

use ReflectionClass;
use Illuminate\Support\Collection;

class ReporterRole
{
  public const VICTIM = 'Korban';
  public const FAMILY = 'Keluarga';
  public const FRIEND = 'Teman';
  public const NEIGHBOR = 'Tetangga';

  public static function all(): Collection
  {
    $class = new ReflectionClass(__CLASS__);
    return collect($class->getConstants());
  }
}
