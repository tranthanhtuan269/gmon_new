<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs';

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
    protected $fillable = ['name', 'number', 'expiration_date', 'work_time', 'public', 'description', 'requirement', 'benefit', 'time_start', 'city', 'district', 'position', 'experience', 'education', 'job_type', 'work_type', 'salary', 'gender', 'age', 'company', 'vip', 'branches', 'views', 'applied'];

    
}
