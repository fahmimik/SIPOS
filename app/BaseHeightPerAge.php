<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseHeightPerAge extends Model
{
    protected $attributes = ['id', 'gender', 'month', 'line', 'value'];
}
