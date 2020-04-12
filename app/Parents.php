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
 * @property Pregnant[] $pregnants
 */
class Parents extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['religion_id', 'name', 'gender', 'nik', 'job', 'birth_date', 'birth_place', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['birth_date', 'created_at', 'updated_at', 'deleted_at'];

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
    public function pregnants()
    {
        return $this->hasMany('App\Pregnant');
    }
}
