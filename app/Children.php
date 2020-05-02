<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $family_id
 * @property integer $religion_id
 * @property string $name
 * @property string $birth_place
 * @property string $birth_date
 * @property boolean $gender
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Family $family
 * @property Religion $religion
 * @property Activity[] $activities
 */
class Children extends Model
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
    protected $fillable = ['family_id', 'religion_id', 'name', 'birth_place', 'birth_date', 'gender', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['birth_date', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function family()
    {
        return $this->belongsTo('App\Family');
    }

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
    public function activities()
    {
        return $this->hasMany('App\Activity', 'child_id');
    }

    public function getGenderNameAttribute(){ // pelajari ini https://laravel.com/docs/7.x/eloquent-mutators#defining-an-accessor
        return $this->gender === 1 ? 'Perempuan' : 'Laki-Laki'; // pelajari https://davidwalsh.name/php-shorthand-if-else-ternary-operators
    }
}
