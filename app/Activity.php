<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $child_id
 * @property float $weight
 * @property float $height
 * @property boolean $status
 * @property int $age
 * @property boolean $vitamin_a
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Children $children
 * @property BreastMilk[] $breastMilks
 * @property Immunization[] $immunizations
 */
class Activity extends Model
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
    protected $fillable = ['child_id', 'weight', 'height', 'status', 'age', 'vitamin_a', 'notes', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function children()
    {
        return $this->belongsTo('App\Children', 'child_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function breastMilks()
    {
        return $this->belongsToMany('App\BreastMilk', 'breast_milk_activities');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function immunizations()
    {
        return $this->belongsToMany('App\Immunization', 'immunization_activities');
    }
}
