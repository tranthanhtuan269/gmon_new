<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveCV extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'save_cv';
    public $timestamps = false;


    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user', 'cv', 'created_at'];
}
