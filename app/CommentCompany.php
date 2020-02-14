<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentCompany extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments_company';

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
    protected $fillable = ['title', 'description', 'star', 'company'];

    
}
