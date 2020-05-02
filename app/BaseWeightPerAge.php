<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseWeightPerAge extends Model
{
    protected $attributes = ['id', 'gender', 'month', 'line', 'value'];
}
