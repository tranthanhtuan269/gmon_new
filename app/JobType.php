<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class JobType extends Model
{

    use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_types';

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
    protected $fillable = ['name', 'slug'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getIDByName($name){
        $name = rtrim($name,";");
        $jobs = explode(";",$name);
        $sql = "SELECT id FROM job_types WHERE";
        $i = 0; 
        $jobs_want = '';
        foreach($jobs as $j){
            if($i == 0){
                $sql .= " name = '" . $j . "'";
            }else{
                $sql .= " OR name = '" . $j . "'";
            }
            $i++;
        }

        $ret = \DB::select($sql);

        $i = 0;
        foreach ($ret as $r) {
            if($i == 0){
                $jobs_want .= $r->id;
            }else{
                $jobs_want .= ',' . $r->id;
            }
            $i++;
        }

        return $jobs_want;
    }
}
