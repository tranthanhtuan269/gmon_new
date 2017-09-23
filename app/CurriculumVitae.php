<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;

class CurriculumVitae extends \Eloquent
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['user.name', 'id'],
                'separator' => '_'
            ]
        ];
    }
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'curriculum_vitaes';

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
    protected $fillable = ['user', 'avatar', 'birthday', 'gender', 'address', 'city', 'district', 'town', 'education','school', 'word_experience', 'language', 'interests', 'references', 'qualification', 'career_objective', 'images', 'active', 'time_can_work', 'salary_want', 'jobs', 'created_at', 'slug'];

    public function User() {
        return $this->belongsTo(\App\User::class);
    }
}
