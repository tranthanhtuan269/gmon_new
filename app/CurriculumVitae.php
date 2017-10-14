<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumVitae extends Model
{
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
    protected $fillable = ['user', 'avatar', 'birthday', 'gender', 'address', 'city', 'district', 'town', 'education','school', 'word_experience', 'language', 'interests', 'references', 'qualification', 'career_objective', 'images', 'active', 'time_can_work', 'salary_want', 'jobs', 'created_at'];

    public function getCV($district, $city, $from, $number_get){
        $sql = "SELECT 
                    curriculum_vitaes.id, 
                    users.name as username,
                    curriculum_vitaes.birthday, 
                    users.avatar as avatarU, 
                    curriculum_vitaes.avatar as avatarCV, 
                    curriculum_vitaes.school
                FROM 
                    curriculum_vitaes ";
        $sql .= "JOIN 
                    users ON users.id = curriculum_vitaes.user ";
        $sql .= "WHERE 
                    1 = 1 ";
        $sql .= "AND 
                    (users.avatar is not null OR curriculum_vitaes.avatar is not null)";
        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND curriculum_vitaes.district = $district";
            }else{
                $sql .= " AND curriculum_vitaes.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND curriculum_vitaes.city NOT IN (1, 2, 3)";
        }
        $sql .= " ORDER BY curriculum_vitaes.id DESC";
        $sql .= " LIMIT $from, $number_get";

        return \DB::select($sql);
    }

    public function getCVNumber($district, $city, $from, $number_get){
        $sql = "SELECT 
                    count(curriculum_vitaes.id) AS number_cv
                FROM 
                    curriculum_vitaes ";
        $sql .= "JOIN 
                    users ON users.id = curriculum_vitaes.user ";
        $sql .= "WHERE 
                    1 = 1 ";

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND curriculum_vitaes.district = $district";
            }else{
                $sql .= " AND curriculum_vitaes.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND curriculum_vitaes.city NOT IN (1, 2, 3)";
        }

        return \DB::select($sql);
    }
}
