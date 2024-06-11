<?php

namespace App\Constants;

use ReflectionClass;
use Illuminate\Support\Collection;

class ViolenceCategory
{
    public const PHYSICAL_HARASSMENT = [
        'name' => 'Pelecehan Fisik',
        'description' => 'Tindakan kekerasan yang dilakukan terhadap tubuh seseorang, termasuk memukul, menendang, dan tindakan lainnya yang menyebabkan cedera fisik atau rasa sakit.'
    ];
    
    public const MENTAL_HARASSMENT = [
        'name' => 'Pelecehan Mental',
        'description' => 'Tindakan yang bertujuan menyebabkan tekanan emosional atau psikologis, seperti penghinaan, ancaman, dan manipulasi yang merusak kesejahteraan mental atau emosional.'
    ];

    public static function all(): Collection
    {
        $class = new ReflectionClass(__CLASS__);
        return collect($class->getConstants());
    }
}