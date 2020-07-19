<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseWeightPerHeight extends Model
{
    protected $attributes = ['id', 'gender', 'toddler', 'height', 'line', 'weight'];
}
