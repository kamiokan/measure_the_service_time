<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ServiceTime extends Entity
{
    protected $_accessible = [
        '*'  => true,
        'id' => false,
    ];
}
