<?php

namespace Eliasmpjunior\Caravela\Models;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    protected $connection = 'caravela';
    protected $keyType = 'string';
    public $incrementing = false;

    /*
    protected $casts = [
        'outgoing_map' => 'array',
    ];
    */
}
