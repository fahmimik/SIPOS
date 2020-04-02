<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $religion_id
 * @property string $name
 * @property boolean $gender
 * @property string $nik
 * @property string $job
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Religion $religion
 * @property Family[] $families
 * @property Family[] $families
 * @property Pregnant[] $pregnants
 */
class Parent extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['religion_id', 'name', 'gender', 'nik', 'job', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function religion()
    {
        return $this->belongsTo('App\Religion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function families()
    {
        return $this->hasMany('App\Family', 'father_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function families()
    {
        return $this->hasMany('App\Family', 'mother_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pregnants()
    {
        return $this->hasMany('App\Pregnant');
    }
}
