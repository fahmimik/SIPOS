<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $mother_id
 * @property integer $father_id
 * @property string $married_at
 * @property string $address
 * @property string $no_kk
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Children[] $childrens
 * @property ParentsNote[] $parentNotes
 */
class Family extends Model
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
    protected $fillable = ['mother_id', 'father_id', 'married_at', 'address', 'no_kk', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['married_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function father()
    {
        return $this->belongsTo('App\Parents', 'father_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mother()
    {
        return $this->belongsTo('App\Parents', 'mother_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens()
    {
        return $this->hasMany('App\Children');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parentNotes()
    {
        return $this->hasMany('App\ParentsNote');
    }
}
