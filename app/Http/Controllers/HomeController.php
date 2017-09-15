<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyCompanyType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = 1; //hanoi // 2 = hochiminh // 3 =  danang

        if(isset($_GET['city']) && is_numeric($_GET['city'])){
            $city = (int)$_GET['city'];
        }

        // get district of city
        $districts = \DB::table('districts')
                    ->where('districts.city', '=', $city)
                    ->get();   

        // get cv of vip
        $cvs = \DB::table('curriculum_vitaes')
                    ->where('curriculum_vitaes.vip', '=', 1)
                    ->take(10)
                    ->get();  

        return view('home', compact('districts'));
    }

    public function welcome()
    {
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
        }
        $city = 0;
        $district = 0;
        if(isset($_GET['district']) && is_numeric($_GET['district'])){
            $district = (int)$_GET['district'];
        }
        
        if(isset($_GET['city']) && is_numeric($_GET['city'])){
            $city = (int)$_GET['city'];
        }

        $partners = \App\Partner::take(5)->get();
        // dd($partners);

        if($district > 0){
            // get district of city
            $district = \DB::table('districts')
                        ->where('districts.id', '=', $district)
                        ->where('districts.active', '=', 1)
                        ->first();   

            if($district){
                // get district of city
                $districts = \DB::table('districts')
                        ->where('districts.city', '=', $district->city)
                        ->where('districts.active', '=', 1)
                        ->get(); 

                $city = $district->city;

                // get job of vip
                $jobsvip1 = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district->id)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->orderBy('jobs.created_at', 'desc')
                        ->take(10)
                        ->get();

                // get job of vip
                $jobsvip2 = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district->id)
                        ->where('jobs.vip', '=', 2)
                        ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->orderBy('jobs.created_at', 'desc')
                        ->take(10)
                        ->get();

                // get job of vip
                $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district->id)
                        ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->orderBy('jobs.created_at', 'desc')
                        ->take(10)
                        ->get();

                // get cv of vip
                $cvs = \DB::table('curriculum_vitaes')
                    ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                    ->select('curriculum_vitaes.id as id', 'users.name as username', 'curriculum_vitaes.birthday', 'curriculum_vitaes.avatar', 'curriculum_vitaes.school')
                    ->where('curriculum_vitaes.district', '=', $district->id)
                    ->orderBy('curriculum_vitaes.created_at', 'desc')
                    ->take(10)
                    ->get();  
                // get cv of vip
                $companies = \DB::table('companies')
                    ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                    ->where('company_company_types.company_type', '=', 5)
                    ->select('companies.id', 'companies.name', 'companies.logo')
                    ->where('companies.district', '=', $district->id)
                    ->orderBy('companies.created_at', 'desc')
                    ->take(20)
                    ->get();
            }else{
                return redirect('/');
            }
        }else{

            if(isset($_GET['city']) && is_numeric($_GET['city'])){
                $city = (int)$_GET['city'];
            }
            
            if($city == 0){
                // get district of city
                $districts = \DB::table('districts')
                            ->where('districts.city', '=', 1)
                            ->where('districts.active', '=', 1)
                            ->get(); 
                // get job of vip
                $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->orderBy('jobs.created_at', 'desc')
                        ->take(10)
                        ->get(); 
                
                
                // get job of vip
                $jobsvip1 = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->orderBy('jobs.created_at', 'desc')
                        ->take(10)
                        ->get();

                // get job of vip
                $jobsvip2 = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('jobs.vip', '=', 2)
                        ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->orderBy('jobs.created_at', 'desc')
                        ->take(10)
                        ->get();

                // get cv of vip
                $cvs = \DB::table('curriculum_vitaes')
                    ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                    ->select('curriculum_vitaes.id as id', 'users.name as username', 'curriculum_vitaes.birthday', 'curriculum_vitaes.avatar', 'curriculum_vitaes.school')
                    ->orderBy('curriculum_vitaes.created_at', 'desc')
                    ->take(10)
                    ->get();  
                // get cv of vip
                $companies = \DB::table('companies')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo')
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();
            }else{
                // get district of city
                $districts = \DB::table('districts')
                            ->where('districts.city', '=', $city)
                            ->where('districts.active', '=', 1)
                            ->get(); 
                // get job of vip
                $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->orderBy('jobs.created_at', 'desc')
                        ->take(10)
                        ->get(); 
                
                // get job of vip
                $jobsvip1 = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->orderBy('jobs.created_at', 'desc')
                        ->take(10)
                        ->get();

                // get job of vip
                $jobsvip2 = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.vip', '=', 2)
                        ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->orderBy('jobs.created_at', 'desc')
                        ->take(10)
                        ->get();

                // get cv of vip
                $cvs = \DB::table('curriculum_vitaes')
                    ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                    ->select('curriculum_vitaes.id as id', 'users.name as username', 'curriculum_vitaes.birthday', 'curriculum_vitaes.avatar', 'curriculum_vitaes.school')
                    ->where('curriculum_vitaes.city', '=', $city)
                    ->orderBy('curriculum_vitaes.created_at', 'desc')
                    ->take(10)
                    ->get();  
                // get cv of vip
                $companies = \DB::table('companies')
                        ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo')
                        ->where('companies.city', '=', $city)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();
            }
        }  
        
        $this_day = date('Y-m-d H:i:s');
        $cvcount = \DB::table('curriculum_vitaes')->count();
        $jobcount0 = \DB::table('jobs')
                ->where('expiration_date', '=', date("d/m/Y"))
                ->count();
        $jobcount1 = \DB::table('jobs')
                ->where('expiration_date', '=', date("d/m/Y", strtotime($this_day . ' +1 day')))
                ->count();
        $jobcount2 = \DB::table('jobs')
                ->where('expiration_date', '=', date("d/m/Y", strtotime($this_day . ' +2 day')))
                ->count();
        $jobcount3 = \DB::table('jobs')
                ->where('expiration_date', '=', date("d/m/Y", strtotime($this_day . ' +3 day')))
                ->count();

        return view('welcome', compact('jobcount0', 'jobcount1', 'jobcount2', 'jobcount3', 'cvcount' ,'districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'partners'));
    }

    public function getDistrict($id){
        $districts = \DB::table('districts')
                    ->where('districts.city', '=', $id)
                    ->get();   
        $html = "";
        $html .= '<option value="0">Quận / Huyện</option>';
        foreach ($districts as $district) {
            $html .= '<option value="'.$district->id.'">'.$district->name.'</option>';
        }
        return $html;
    }

    public function getTown($id){
        $towns = \DB::table('towns')
                    ->where('towns.district', '=', $id)
                    ->get();   
        $html = "";
        $html .= '<option value="0">Phường / Xã</option>';
        foreach ($towns as $town) {
            $html .= '<option value="'.$town->id.'">'.$town->name.'</option>';
        }
        return $html;
    }
    
    public function postImage(Request $request){
        $img_file = '';
        if ($request->hasFile('input_file_name')) {
            $file_img = $request->file('input_file_name');
            $filename = $file_img->getClientOriginalName();
            $extension = $file_img->getClientOriginalExtension();
            $img_file = date('His') . $filename;
            $destinationPath = base_path('../../images');
            $file_img->move($destinationPath, $img_file);
            return \Response::json(array('code' => '200', 'message' => 'success', 'image_url' => $img_file));
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'image_url' => ""));
    }

    public function showmore()
    {
        $perPage = 1000;
        $checkJobVip = 0;
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
        }
        $city = 0;
        $district = 0;
        $cv = "";
        $job = "";
        $company = "";
        $job_type = "";
        if(isset($_GET['district']) && is_numeric($_GET['district'])){
            $district = (int)$_GET['district'];
        }
        
        if(isset($_GET['city']) && is_numeric($_GET['city'])){
            $city = (int)$_GET['city'];
        }else if(isset($_GET['city']) && $_GET['city'] == 'other'){
            $city = 1000;
        }

        if(isset($_GET['cv'])){
            $cv = $_GET['cv'];
        }

        if(isset($_GET['job'])){
            $job = $_GET['job'];
        }

        if(isset($_GET['job_type'])){
            $job_type = $_GET['job_type'];
        }
        
        if(isset($_GET['company'])){
            $company = $_GET['company'];
        }

        if($district > 0){
            // get district of city
            $districtObj = \DB::table('districts')
                        ->where('districts.id', '=', $district)
                        ->first();   
            if($districtObj){
                $city = $districtObj->city;

                if($cv == "vip"){
                    // get job of vip
                    $jobsvip1 = [];

                    // get job of vip
                    $jobsvip2 = [];

                    // get job of vip
                    $jobs = [];

                    // get cv of vip
                    $cvs = \DB::table('curriculum_vitaes')
                        ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                        ->select('curriculum_vitaes.id as id', 'users.name as username', 'curriculum_vitaes.birthday', 'curriculum_vitaes.avatar', 'curriculum_vitaes.school')
                        ->where('curriculum_vitaes.district', '=', $district)
                        ->paginate($perPage);
                        
                    // get cv of vip
                    $companies = [];

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showCompanyCV', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "vip1"){
                    $checkJobVip = 1;
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->where('jobs.vip', '=', 2)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.district', '=', $district)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "vip2"){
                    $checkJobVip = 1;
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->where('jobs.vip', '=', 2)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.district', '=', $district)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "new"){
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.district', '=', $district)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job_type > 0){
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->where('jobs.job_type', '=', $job_type)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->where('jobs.vip', '=', 1)
                        ->where('jobs.job_type', '=', $job_type)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.district', '=', $district)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($company == "new"){
                    // get job of vip
                    $jobsvip1 = [];

                    // get job of vip
                    $jobsvip2 = [];

                    // get job of vip
                    $jobs = [];

                    // get cv of vip
                    $cvs = [];
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.district', '=', $district)
                        ->orderBy('companies.created_at', 'desc')
                        ->take($perPage)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showCompanyCV', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else{
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.district', '=', $district)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.district', '=', $district)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();
                            
                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }
            }else{
                return redirect('/');
            }
        }else{
            if(isset($_GET['city']) && is_numeric($_GET['city'])){
                $city = (int)$_GET['city'];
            }

            if($city == 1000){
                $jobs = [];

                // get job of vip
                $jobsvip1 = [];

                // get job of vip
                $jobsvip2 = [];

                // get cv of vip
                $cvs = [];

                // get cv of vip
                $companies = []; 
            }

            if($city > 0){
                // get district of city
                $districts = \DB::table('districts')
                            ->where('districts.city', '=', $city)
                            ->where('districts.active', '=', 1)
                            ->get();   

                if($cv == "vip"){
                    // get job of vip
                    $jobs = [];

                    // get job of vip
                    $jobsvip1 = [];

                    // get job of vip
                    $jobsvip2 = [];

                    // get cv of vip
                    $cvs = \DB::table('curriculum_vitaes')
                        ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                        ->select('curriculum_vitaes.id as id', 'users.name as username', 'curriculum_vitaes.birthday', 'curriculum_vitaes.avatar', 'curriculum_vitaes.school')
                        ->where('curriculum_vitaes.city', '=', $city)
                        ->paginate($perPage);

                    // get cv of vip
                    $companies = []; 

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showCompanyCV', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "vip1"){
                    $checkJobVip = 1;
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.vip', '=', 2)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.city', '=', $city)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "vip2"){
                    $checkJobVip = 1;
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.vip', '=', 2)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.city', '=', $city)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "new"){
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.city', '=', $city)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job_type > 0){
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.job_type', '=', $job_type)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.vip', '=', 1)
                        ->where('jobs.job_type', '=', $job_type)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.city', '=', $city)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($company == "new"){
                    // get job of vip
                    $jobsvip1 = [];

                    // get job of vip
                    $jobsvip2 = [];

                    // get job of vip
                    $jobs = [];

                    // get cv of vip
                    $cvs = [];
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.city', '=', $city)
                        ->orderBy('companies.created_at', 'desc')
                        ->take($perPage)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showCompanyCV', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else{
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('companies.city', '=', $city)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->where('companies.city', '=', $city)
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }
            }else{

                if($cv == "vip"){
                    // get job of vip
                    $jobs = [];

                    // get job of vip
                    $jobsvip1 = [];

                    // get job of vip
                    $jobsvip2 = [];

                    // get cv of vip
                    $cvs = \DB::table('curriculum_vitaes')
                        ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                        ->select('curriculum_vitaes.id as id', 'users.name as username', 'curriculum_vitaes.birthday', 'curriculum_vitaes.avatar', 'curriculum_vitaes.school')
                        ->paginate($perPage);

                    // get cv of vip
                    $companies = []; 

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showCompanyCV', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "vip1"){
                    $checkJobVip = 1;
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('jobs.vip', '=', 2)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "vip2"){
                    $checkJobVip = 1;
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('jobs.vip', '=', 2)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "new"){
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('jobs.vip', '=', 1)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                 }else if($job_type > 0){
                    // get job of vip
                    $jobs = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('jobs.job_type', '=', $job_type)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->paginate($perPage);

                    $jobsvip = \DB::table('jobs')
                        ->join('companies', 'companies.id', '=', 'jobs.company')
                        ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->join('districts', 'districts.id', '=', 'companies.district')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->where('jobs.vip', '=', 1)
                        ->where('jobs.job_type', '=', $job_type)
                        ->select('jobs.id as id', 'jobs.name as name', 'jobs.number as number', 'jobs.views as views', 'jobs.applied as applied', 'jobs.expiration_date as expiration_date', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                        ->take(5)
                        ->get();
                        
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->orderBy('companies.created_at', 'desc')
                        ->take(20)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($company == "new"){
                    // get job of vip
                    $jobsvip1 = [];

                    // get job of vip
                    $jobsvip2 = [];

                    // get job of vip
                    $jobs = [];

                    // get cv of vip
                    $cvs = [];
                    // get cv of vip
                    $companies = \DB::table('companies')
                        ->join('company_company_types', 'companies.id', '=', 'company_company_types.company')
                        ->where('company_company_types.company_type', '=', 5)
                        ->select('companies.id', 'companies.name', 'companies.logo', 'companies.sologan')
                        ->orderBy('companies.created_at', 'desc')
                        ->take($perPage)
                        ->get();

                    $news = \DB::table('posts')
                            ->select('id', 'title', 'image')
                            ->orderBy('posts.created_at', 'desc')
                            ->take(5)->get();

                    return view('showCompanyCV', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }
            }
            
        }

        return redirect('/home');
    }
    
    public function action(){
        $companies = \DB::table('companies')
                        ->get();
        foreach($companies as $company){
            $company->jobs=rtrim($company->jobs,";");
            $jobLists = explode(";",$company->jobs);
            foreach($jobLists as $job){
                if($job == 'Khách sạn'){
                    $cct = CompanyCompanyType::where('company', $company->id)->where('company_type', 1)->first();
                    if($cct == null){
                        echo $company->id .' - '. $job . ';';
                        $companyCompanyType = new CompanyCompanyType;
                        $companyCompanyType->company = $company->id;
                        $companyCompanyType->company_type = 1;
                        $companyCompanyType->save();
                        echo 'Success <br />';
                    }
                }else if($job == 'Nhà Hàng'){
                    $cct = CompanyCompanyType::where('company', $company->id)->where('company_type', 2)->first();
                    if($cct == null){
                        echo $company->id .' - '. $job . ';';
                        $companyCompanyType = new CompanyCompanyType;
                        $companyCompanyType->company = $company->id;
                        $companyCompanyType->company_type = 2;
                        $companyCompanyType->save();
                        echo 'Success <br />';
                    }
                }else if($job == 'Cửa hàng'){
                    $cct = CompanyCompanyType::where('company', $company->id)->where('company_type', 3)->first();
                    if($cct == null){
                        echo $company->id .' - '. $job . ';';
                        $companyCompanyType = new CompanyCompanyType;
                        $companyCompanyType->company = $company->id;
                        $companyCompanyType->company_type = 3;
                        $companyCompanyType->save();
                        echo 'Success <br />';
                    }
                }else if($job == 'Doanh nghiệp'){
                    $cct = CompanyCompanyType::where('company', $company->id)->where('company_type', 4)->first();
                    if($cct == null){
                        echo $company->id .' - '. $job . ';';
                        $companyCompanyType = new CompanyCompanyType;
                        $companyCompanyType->company = $company->id;
                        $companyCompanyType->company_type = 4;
                        $companyCompanyType->save();
                        echo 'Success <br />';
                    }
                }else if($job == 'Spa'){
                    $cct = CompanyCompanyType::where('company', $company->id)->where('company_type', 5)->first();
                    if($cct == null){
                        echo $company->id .' - '. $job . ';';
                        $companyCompanyType = new CompanyCompanyType;
                        $companyCompanyType->company = $company->id;
                        $companyCompanyType->company_type = 5;
                        $companyCompanyType->save();
                        echo 'Success <br />';
                    }
                }
                echo '<br />';
            }
        }
    }
}
