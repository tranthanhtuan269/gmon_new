<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Job extends Model
{
    use Sluggable;
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
    protected $fillable = ['name', 'number', 'expiration_date', 'work_time', 'public', 'description', 'requirement', 'benefit', 'time_start', 'city', 'district', 'position', 'experience', 'education', 'job_type', 'work_type', 'salary', 'gender', 'age', 'company', 'vip', 'branches', 'views', 'applied', 'slug'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['name', 'id'],
                'separator' => '_'
            ]
        ];
    }

    public function getJob($district, $city, $field, $job_type, $company, $cv, $vip, $from, $number_get){
        $ret_data = [];

            $sql = "SELECT 
                    jobs.id AS id, 
                    jobs.name AS name, 
                    jobs.number AS number, 
                    jobs.views as views, 
                    jobs.applied AS applied, 
                    jobs.expiration_date AS expiration_date, 
                    jobs.slug, 
                    salaries.name AS salary, companies.logo, 
                    companies.name AS companyname, 
                    cities.name AS city, 
                    districts.name AS district 
                FROM 
                    jobs
                JOIN 
                    companies ON companies.id = jobs.company";
        if($field > 0 && $field < 6){
            $sql .= " JOIN 
                    company_company_types ON companies.id = company_company_types.company";
        }
            $sql .= " JOIN
                    salaries ON salaries.id = jobs.salary
                JOIN
                    cities ON cities.id = companies.city
                JOIN
                    districts ON districts.id = companies.district";

            $sql .= " WHERE 1 = 1 AND jobs.active = 1";
        if($vip == 1){
            $sql .= " AND jobs.vip = 1";
        }else if($vip == 2){
            $sql .= " AND jobs.vip = 2";
        }

        if($job_type > 0){
            $sql .= " AND jobs.job_type = $job_type";
        }

        if($field > 0 && $field < 6){
            $sql .= " AND company_company_types.company_type = $field";
        }

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND companies.district = $district";
            }else{
                $sql .= " AND companies.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND companies.city NOT IN (1, 2, 3)";
        }

            $sql .= " ORDER BY jobs.updated_at DESC";
            $sql .= " LIMIT $from, $number_get";

        return \DB::select($sql);
    }

    public function getJobNumber($district, $city, $field, $job_type, $company, $cv, $vip){
        $ret_data = [];

            $sql = "SELECT 
                    count(jobs.id) AS number_job
                FROM 
                    jobs
                JOIN 
                    companies ON companies.id = jobs.company";
        if($field > 0 && $field < 6){
            $sql .= " JOIN 
                    company_company_types ON companies.id = company_company_types.company";
        }
            $sql .= " JOIN
                    salaries ON salaries.id = jobs.salary
                JOIN
                    cities ON cities.id = companies.city
                JOIN
                    districts ON districts.id = companies.district";

            $sql .= " WHERE 1 = 1";
        if($vip == 1){
            $sql .= " AND jobs.vip = 1";
        }else if($vip == 2){
            $sql .= " AND jobs.vip = 2";
        }

        if($job_type > 0){
            $sql .= " AND jobs.job_type = $job_type";
        }

        if($field > 0 && $field < 6){
            $sql .= " AND company_company_types.company_type = $field";
        }

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND companies.district = $district";
            }else{
                $sql .= " AND companies.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND companies.city NOT IN (1, 2, 3)";
        }

        return \DB::select($sql);
    }

    public function getJobWithBanner($start, $number){
        $sql = "SELECT 
                    jobs.id,
                    REPLACE(jobs.name, \"'\", \"&apos;\") as jobName,
                    jobs.slug,
                    jobs.views,
                    jobs.applied,
                    REPLACE(companies.name, \"'\", \"&apos;\") as companyName,
                    companies.banner,
                    REPLACE(companies.sologan, \"'\", \"&apos;\") as sologan
                FROM 
                    jobs 
                JOIN 
                    companies on jobs.company = companies.id
                WHERE 
                    jobs.active = 1
                ORDER BY jobs.updated_at DESC
                ";
        $sql .= " LIMIT $start, $number";

        return \DB::select($sql);
    }

    public function getJobApplied($user_id, $district, $city, $field, $job_type, $from, $number_get){
        $ret_data = [];

            $sql = "SELECT 
                    jobs.id AS id, 
                    jobs.name AS name, 
                    jobs.number AS number, 
                    jobs.views as views, 
                    jobs.applied AS applied, 
                    jobs.expiration_date AS expiration_date, 
                    jobs.slug, 
                    salaries.name AS salary, companies.logo, 
                    companies.name AS companyname, 
                    cities.name AS city, 
                    districts.name AS district 
                FROM 
                    jobs
                JOIN 
                    companies ON companies.id = jobs.company
                JOIN 
                    applies ON applies.job = jobs.id";
        if($field > 0 && $field < 6){
            $sql .= " JOIN 
                    company_company_types ON companies.id = company_company_types.company";
        }
            $sql .= " JOIN
                    salaries ON salaries.id = jobs.salary
                JOIN
                    cities ON cities.id = companies.city
                JOIN
                    districts ON districts.id = companies.district";

            $sql .= " WHERE 1 = 1";

        if($job_type > 0){
            $sql .= " AND jobs.job_type = $job_type AND jobs.active = 1";
        }

        if($field > 0 && $field < 6){
            $sql .= " AND company_company_types.company_type = $field";
        }

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND companies.district = $district";
            }else{
                $sql .= " AND companies.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND companies.city NOT IN (1, 2, 3)";
        }

            $sql .= " AND applies.user = " . $user_id;

            $sql .= " ORDER BY jobs.updated_at DESC";
            $sql .= " LIMIT $from, $number_get";

        return \DB::select($sql);
    }

    public function getJobRelative($district, $city, $salary_want, $jobs_want, $from, $number_get){
        $ret_data = [];

            $sql = "SELECT 
                    jobs.id AS id, 
                    jobs.name AS name, 
                    jobs.number AS number, 
                    jobs.views as views, 
                    jobs.applied AS applied, 
                    jobs.description AS description, 
                    jobs.expiration_date AS expiration_date, 
                    jobs.slug, 
                    salaries.name AS salary, 
                    companies.logo, 
                    companies.name AS companyname, 
                    cities.name AS city, 
                    districts.name AS district
                FROM 
                    jobs
                JOIN 
                    companies ON companies.id = jobs.company AND jobs.active = 1";
            $sql .= " JOIN
                    salaries ON salaries.id = jobs.salary
                JOIN
                    cities ON cities.id = companies.city
                JOIN
                    districts ON districts.id = companies.district";

            $sql .= " WHERE 1 = 1";

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND companies.district = $district";
            }else{
                $sql .= " AND companies.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND companies.city NOT IN (1, 2, 3)";
        }

        if($salary_want > 1){
            $salary_want_plus = $salary_want + 1;
            $sql .= " AND ( jobs.salary = 1 OR jobs.salary = $salary_want OR jobs.salary = $salary_want_plus)";
        }

        if(strlen($jobs_want) > 0){
            $sql .= " AND jobs.job_type in ($jobs_want)";
        }

            $sql .= " ORDER BY jobs.updated_at DESC";
            $sql .= " LIMIT $from, $number_get";
        return \DB::select($sql);
    }

    public function getFirstJobCreatedByID($id, $active = null){

        // get company from $id
        $company = Company::where("user", "=", $id)->orderBy("created_at", "DESC")->select("id")->first();

        if($company != null){
            $sql = "SELECT 
                    jobs.id AS id
                FROM 
                    jobs
                WHERE 
                    jobs.company = $company->id AND jobs.active = 1";
            if($active == 1){
                $sql .= " AND STR_TO_DATE(jobs.expiration_date, '%d/%m/%Y') > CURDATE()";
            }elseif($active == 2){
                $sql .= " AND STR_TO_DATE(jobs.expiration_date, '%d/%m/%Y') < CURDATE()";
            }
                $sql .= " ORDER BY jobs.updated_at DESC";
                $sql .= " LIMIT 0, 1";
        }else{
            $sql = "";
        }

        return \DB::select($sql);
    }

    public function getJobCreatedByID($id, $active = null){

        // get company from $id
        $company = Company::where("user", "=", $id)->orderBy("created_at", "DESC")->select("id")->first();

        if($company != null){
            $sql = "SELECT 
                    jobs.id AS id, 
                    jobs.name AS name, 
                    jobs.number AS number, 
                    -- jobs.views as views, 
                    jobs.applied AS applied, 
                    jobs.created_at AS created_at,
                    jobs.expiration_date AS expiration_date, 
                    jobs.slug
                FROM 
                    jobs
                WHERE 
                    jobs.company = $company->id AND jobs.active = 1";
            if($active == 1){
                $sql .= " AND STR_TO_DATE(jobs.expiration_date, '%d/%m/%Y') > CURDATE()";
            }elseif($active == 2){
                $sql .= " AND STR_TO_DATE(jobs.expiration_date, '%d/%m/%Y') < CURDATE()";
            }
            $sql .= " ORDER BY jobs.updated_at DESC";
        }else{
            $sql = "";
        }
        // dd($sql);

        return \DB::select($sql);
    }
}
