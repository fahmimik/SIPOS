<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $family_id
 * @property float $lila
 * @property boolean $savings
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Family $family
 * @property Contraception[] $contraceptions
 */
class ParentsNote extends Model
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
    protected $fillable = ['family_id', 'lila', 'savings', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function family()
    {
        return $this->belongsTo('App\Family');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contraceptions()
    {
        return $this->belongsToMany('App\Contraception', 'parent_note_contraceptions');
    }
}
