<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseImtPerAge extends Model
{
    protected $attributes = ['id', 'gender', 'month', 'line', 'value'];
}
