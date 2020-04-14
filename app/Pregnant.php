<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property int $number_of_pregnant
 * @property float $lila
 * @property float $weight
 * @property int $pregnant_age
 * @property int $blood_pill
 * @property string $tetanus_immunization
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Parents $parent
 */
class Pregnant extends Model
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
    protected $fillable = ['parent_id','visit_at', 'number_of_pregnant', 'lila', 'weight', 'pregnant_age', 'blood_pill', 'tetanus_immunization', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['visit_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Parents');
    }
}
