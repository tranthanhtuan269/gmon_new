<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'type', 'password', 'id_fb', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'phone', 'type', 'remember_token',
    ];

    public function getUserInfo(){
        $company_id = -1;
        $cv_id = -1;
        $returnData = [];
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;
            //get company 
            $company = \DB::table('companies')
                    ->where('companies.user', $current_id)->orderBy("created_at", "DESC")
                    ->select(
                        'id'
                    )
                    ->first();
            if($company){
                $company_id = $company->id;
            }
            
            //get CV 
            $cv_user = \DB::table('curriculum_vitaes')
                    ->where('curriculum_vitaes.user', $current_id)->orderBy("created_at", "DESC")
                    ->select(
                        'id',
                        'avatar'
                    )
                    ->first();
            if($cv_user != null){
                $cv_id = $cv_user->id;
            }

            $returnData['user_id'] = $current_id;
            $returnData['company_id'] = $company_id;
            $returnData['cv_id'] = $cv_id;
            return $returnData;
        }
    }

    public function getRelativeJob($user_id){
        // check relative exist in system
        $relative = \DB::table('relatives')->where('user', '=', $user_id)->first();

        // if null
        if(!isset($relative)){
            // create relative
            // get city, district, salary, jobs in CV
            $cv_user = \DB::table('curriculum_vitaes')
                ->where('curriculum_vitaes.user', $user_id)
                ->select(
                    'id',
                    'city',
                    'district',
                    'salary_want',
                    'jobs'
                )
                ->first();
            if(isset($cv_user)){
                // step 2: get city, district, salary, job
                $jobTypeGetObj = new \App\JobType;

                $city = $cv_user->city;
                $district = $cv_user->district;
                $salary_want = $cv_user->salary_want;
                $jobs_want = $jobTypeGetObj->getIDByName($cv_user->jobs);

                // save to database
                $arr = array();
                $arr['city'] = $city;
                $arr['district'] = $district;
                $arr['salary_want'] = $salary_want;
                $arr['jobs_want'] = $jobs_want;
                $rel = new Relative;
                $rel->user = $user->id;
                $rel->json = json_encode($arr);
                $rel->save();
            }
        }else{
            $rel = json_decode($relative->json);
            $city = $rel->city;
            $district = $rel->district;
            $salary_want = $rel->salary_want;
            $jobs_want = $rel->jobs_want;
        }

        return array('city'=>$city, 'district'=>$district, 'salary_want'=>$salary_want,'jobs_want'=>$jobs_want);
    }
}
