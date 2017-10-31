<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Company extends Model
{
    use Sluggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

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
    protected $fillable = ['user', 'banner', 'logo', 'name', 'sub_name', 'tax_code', 'sologan', 'size', 'jobs', 'city', 'district', 'town', 'address', 'description', 'images', 'branchs', 'lat', 'lng', 'youtube_link', 'template', 'site_url', 'show_master', 'slug'];

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

    public function getPhoneNumber($user_id){
        $user = User::findOrFail($user_id);
        if($user)
            return $user->phone;
        return '';
    }

    public function getCompany($district, $city, $field, $from, $number_get){
        $sql = "SELECT 
                    companies.id, 
                    companies.name, 
                    companies.logo, 
                    companies.slug, 
                    companies.sologan
                FROM 
                    companies ";
        if($field > 0 && $field < 6){
            $sql .= "JOIN 
                    company_company_types ON companies.id = company_company_types.company ";
        }
        $sql .= "WHERE 
                    1 = 1 ";

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND companies.district = $district";
            }else{
                $sql .= " AND companies.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND companies.city NOT IN (1, 2, 3)";
        }

        if($field > 0 && $field < 6){
            $sql .= " AND company_company_types.company_type = $field";
        }
            $sql .= " ORDER BY companies.id DESC";
            $sql .= " LIMIT $from, $number_get";

        return \DB::select($sql);
    }

    public function getCompanyWithBannerFollowJob($district, $city, $field, $from, $number_get, $user_id=null){
        $sql = "SELECT 
                    companies.id, 
                    companies.name, 
                    companies.logo, 
                    companies.banner, 
                    companies.slug, 
                    companies.sologan,
                    companies.description,
                    count(jobs.id) as jobNumber,
                    count(follows.id) as followNumber
                FROM 
                    companies 
                LEFT JOIN 
                    jobs on jobs.company = companies.id 
                LEFT JOIN 
                    follows on follows.company = companies.id ";
        if($user_id != null){
            $sql .= "WHERE follows.user = $user_id ";
        }
        $sql .= "GROUP BY companies.id, companies.name, companies.banner, companies.slug, companies.sologan, companies.description, companies.logo
                ORDER BY companies.id DESC
                ";

                $sql .= " LIMIT $from, $number_get";
        return \DB::select($sql);
    }
}
