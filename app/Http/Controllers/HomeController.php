<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyCompanyType;
use App\User;
use App\Company;
use App\CurriculumVitae;
use App\Job;
use App\Post;
use App\Category;
use App\JobType;
use App\CompanyType;
use App\Relative;
use App\SaveCV;
use App\Apply;
use App\Mail\JobSuggest;
use Mail;

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
        $jobGetObj = new Job;
        $companyGetObj = new Company;
        $cvGetObj = new CurriculumVitae;
        $perPage = 1000;
        $checkJobVip = 0;
        $field = $district = $city = $job_type = $company = $cv = $vip = $from = $number_get = null;
        $from  = 0;
        $number_get = 10;

        $title = '';
        $description = '';
        $keyword = '';

        if(isset($_GET['district']) && is_numeric($_GET['district'])){
            $district = (int)$_GET['district'];
        }
        
        if(isset($_GET['city']) && is_numeric($_GET['city'])){
            $city = (int)$_GET['city'];
        }else if(isset($_GET['city']) && $_GET['city'] == 'other'){
            $city = 1000;
        }

        if(isset($_GET['field'])){
            $field = $_GET['field'];
        }

        if(isset($_GET['cv'])){
            $cv = $_GET['cv'];
        }

        if(isset($_GET['job'])){
            $job = $_GET['job'];
        }else{
            $job = null;
        }
        
        if(isset($_GET['job_type'])){
            $job_type = $_GET['job_type'];
        }
        
        if(isset($_GET['company'])){
            $company = $_GET['company'];
        }

        $partners = \App\Partner::take(5)->get();

        if($district > 0){
            // get district of city
            $districtObj = \DB::table('districts')
                        ->where('districts.id', '=', $district)
                        ->where('districts.active', '=', 1)
                        ->first();   

            if($districtObj){
                $city = $districtObj->city;

                // get job of vip
                $jobsvip1 = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, $number_get);

                // get job of vip
                $jobsvip2 = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 2, $from, $number_get);

                // get job of vip
                $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, $vip, $from, $number_get);

                // get cv of vip
                $cvs = $cvGetObj->getCV($district, $city, $from, 10);
                // get cv of vip
                $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);
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
                $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, $vip, $from, $number_get);
                
                // get job of vip
                $jobsvip1 = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, $number_get);

                // get job of vip
                $jobsvip2 = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 2, $from, $number_get);

                // get cv of vip
                $cvs = $cvGetObj->getCV($district, $city, $from, 10);
                // get cv of vip
                $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);
            }else{
                // get district of city
                $districts = \DB::table('districts')
                            ->where('districts.city', '=', $city)
                            ->where('districts.active', '=', 1)
                            ->get(); 
                // get job of vip
                $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, $vip, $from, $number_get);
                
                // get job of vip
                $jobsvip1 = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, $number_get);

                // get job of vip
                $jobsvip2 = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 2, $from, $number_get);

                // get cv of vip
                $cvs = $cvGetObj->getCV($district, $city, $from, 10);
                // get cv of vip
                $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);
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

    public function getDistrictLi($id){
        $districts = \DB::table('districts')
                    ->where('districts.city', '=', $id)
                    ->where('active', '=', 1)
                    ->get();   
        $html = "";
        $html .= '<li value="0">Quận / Huyện</li>';
        foreach ($districts as $district) {
            $html .= '<li value="'.$district->id.'">'.$district->name.'</li>';
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

    public function postImages(Request $request){
        // dd(count($request->files));
        $picture = '';
        $allPic = '';
        if (count($request->files) > 0) {
            $files = $request->files;
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His') . $filename;
                $allPic .= $picture . ';';
                $destinationPath = base_path('../../images');
                $file->move($destinationPath, $picture);
            }
            return \Response::json(array('code' => '200', 'message' => 'success', 'images_url' => $allPic));
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'images_url' => ""));
    }

    public function showmore()
    {
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
        }

        $jobGetObj = new Job;
        $companyGetObj = new Company;
        $cvGetObj = new CurriculumVitae;

        $perPage = 25;
        $checkJobVip = 0;
        $district = $city = $field = $job_type = $company = $cv = $vip = $from = $number_get = null;

        $from  = 0;
        $number_get = 10;


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
        }else{
            $job = null;
        }

        if(isset($_GET['field'])){
            $field = $_GET['field'];
        }

        if(isset($_GET['job_type'])){
            $job_type = $_GET['job_type'];
        }
        
        if(isset($_GET['company'])){
            $company = $_GET['company'];
        }

        // get news 
        $news = \DB::table('posts')
           ->select('id', 'title', 'image')
           ->orderBy('posts.created_at', 'desc')
           ->take(5)->get();

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
                    $cvs = $cvGetObj->getCV($district, $city, $from, 10);
                        
                    // get cv of vip
                    $companies = [];

                    return view('showCV', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "vip1"){
                    $checkJobVip = 1;

                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 1);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 2, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($job == "vip2"){
                    $checkJobVip = 1;

                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 1);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 2, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($job == "new"){

                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($field > 0 && $field < 6){
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($job_type > 0){
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
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
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, $perPage);

                    return view('showCompany', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else{
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
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
                    $cvs = $cvGetObj->getCV($district, $city, $from, 10);

                    // get cv of vip
                    $companies = [];

                    return view('showCV', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "vip1"){
                    $checkJobVip = 1;

                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 1, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 2, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($job == "vip2"){
                    $checkJobVip = 1;
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 2, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 2, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($job == "new"){
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($field > 0 && $field < 6){
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($job_type > 0){
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
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
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, $perPage);

                    return view('showCompany', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else{
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
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
                    $cvs = $cvGetObj->getCV($district, $city, $from, 10);

                    // get cv of vip
                    $companies = [];

                    return view('showCV', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }else if($job == "vip1"){
                    $checkJobVip = 1;
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 1, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 2, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($job == "vip2"){
                    $checkJobVip = 1;
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 2, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 2, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($job == "new"){
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                 }else if($field > 0 && $field < 6){
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
                }else if($job_type > 0){
                    $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobcount = $jobGetObj->getJobNumber($district, $city, $field, $job_type, $company, $cv, 0, $from, $number_get);
                    $jobsvip = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, 1, $from, 5);
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

                    return view('showJob', compact('districts', 'city', 'checkJobVip', 'cvs', 'jobs', 'jobsvip', 'companies', 'company_id', 'cv_id', 'news', 'jobcount'));
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
                    $companies = $companyGetObj->getCompany($district, $city, $field, $from, $perPage);

                    return view('showCompany', compact('districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'news'));
                }
            }
            
        }

        return redirect('/home');
    }

    public function homenew(){
        $job_types = \DB::table('job_types')
                        ->select('id', 'name')
                        ->get();

        $cities = \DB::table('cities')
                        ->where('active', '=', 1)
                        ->select('id', 'name')
                        ->get();
        return view('showCompany', compact('job_types', 'cities'));
    }

    public function homenew2(){
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
        }

        $job_types = \DB::table('job_types')
                        ->select('id', 'name', 'slug')
                        ->get();

        $cities = \DB::table('cities')
                        ->where('active', '=', 1)
                        ->select('id', 'name', 'slug')
                        ->get();
        // dd($cv_id);
        // get job of vip
        $companies = \DB::table('companies')
                ->select('id', 'name', 'logo', 'banner', 'slug')
                ->where('show_master', '=', 1)
                ->orderBy('companies.created_at', 'desc')
                ->take(6)
                ->get();
        return view('welcome3', compact('job_types', 'cities', 'companies', 'company_id', 'cv_id'));
    }
    
    public function action(){
        $user = User::findOrFail(1);
        \Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('tuantt6393@gmail.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }

    public function support(){
        return view('home.support01');
    }

    public function privacypolicy(){
        return view('home.privacypolicy');
    }

    public function termsofservice(){
        return view('home.termsofservice');
    }

    public function sendemail(){
        $dataEmail = array('email'=>'support@gmon.com.vn');
        Mail::send('emails.registerUV', [], function($message) use ($dataEmail) {
            $message->from('support@gmon.com.vn', 'gmon.vn');
            $message->to('tuantt6393@gmail.com')->subject('Hello Tran Thanh Tuan');
        });

        // $user = [];
        // Mail::send('emails.registerUV', $user, function($message) use ($user) {
        //     $message->to('tran.thanh.tuan269@gmail.com');
        //     $message->subject('Mailgun Testing');
        // });
        dd('Mail Send Successfully');
    }

    public function ajaxpro(Request $request){
        if(isset($_POST["image"])){
            $data = $_POST["image"];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $imageName = time().'.png';
            $destinationPath = base_path('../../images');
            file_put_contents($destinationPath.'/'.$imageName, $data);
            return \Response::json(array('code' => '200', 'message' => 'success', 'image_url' => $imageName));
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'image_url' => ""));
    }

    public function updateSlug(){
        $companies = \App\Company::select('id')->get();
        foreach($companies as $c){
            $company = \App\Company::find($c->id);
            $company->slug = null;
            $company->save();
        }
        $jobs = \App\Job::select('id')->get();
        foreach($jobs as $j){
            $job = \App\Job::find($j->id);
            $job->slug = null;
            $job->save();
        }
        $cities = \App\City::select('id')->get();
        foreach($cities as $ci){
            $city = \App\City::find($ci->id);
            $city->slug = null;
            $city->save();
        }
        $districts = \App\District::select('id')->get();
        foreach($districts as $di){
            $district = \App\District::find($di->id);
            $district->slug = null;
            $district->save();
        }
        $jobTypes = \App\JobType::select('id')->get();
        foreach($jobTypes as $jt){
            $jobType = \App\JobType::find($jt->id);
            $jobType->slug = null;
            $jobType->save();
        }
        $companyTypes = \App\CompanyType::select('id')->get();
        foreach($companyTypes as $ct){
            $companyType = \App\CompanyType::find($ct->id);
            $companyType->slug = null;
            $companyType->save();
        }
        $posts = \App\Post::select('id')->get();
        foreach($posts as $p){
            $post = \App\Post::find($p->id);
            $post->slug = null;
            $post->save();
        }
        $categories = \App\Category::select('id')->get();
        foreach($categories as $ca){
            $category = \App\Category::find($ca->id);
            $category->slug = null;
            $category->save();
        }
    }

    public function testnew(){
        if (\Auth::check()) {

            $jobGetObj = new Job;
            $field = $district = $city = $job_type = $company = $cv = $vip = null;
            $from = 0;
            $number_get = 5;

            
            $companyGetObj = new Company;

            // get info User
            $myInfo = CurriculumVitae::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'avatar', 'school')->first();
            if($myInfo->avatar == null) $myInfo->avatar = \Auth::user()->avatar;

            $jobsvip = $jobGetObj->getJobWithBanner($from, 5);
            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);
            return view('uv.main', compact('myInfo', 'jobsvip', 'companies'));
        }

        return redirect('/');
    }

    public function usermain(){
        if (\Auth::check()) {

            $jobGetObj = new Job;
            $field = $district = $city = $job_type = $company = $cv = $vip = null;
            $from = 0;
            $number_get = 5;

            
            $companyGetObj = new Company;

            // get info User
            $myInfo = CurriculumVitae::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'avatar', 'school')->first();
            if($myInfo == null){
                $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'logo as avatar', 'name as school')->first();
            }
            if(isset($myInfo->avatar)) $myInfo->avatar = \Auth::user()->avatar;

            $jobsvip = $jobGetObj->getJobWithBanner($from, 5);
            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);
            return view('uv.main', compact('myInfo', 'jobsvip', 'companies'));
        }

        return redirect('/');
    }

    public function userfollow(){
        if (\Auth::check()) {

            $jobGetObj = new Job;
            $field = $district = $city = $job_type = $company = $cv = $vip = null;
            $from = 0;
            $number_get = 5;

            
            $companyGetObj = new Company;

            // get info User
            $myInfo = CurriculumVitae::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'avatar', 'school')->first();
            if($myInfo->avatar == null) $myInfo->avatar = \Auth::user()->avatar;

            $companiesFollowed = $companyGetObj->getCompanyFollowed(\Auth::user()->id, $district, $city, $field, $job_type, $from, 100);
            // dd($jobsvip);
            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);
            return view('uv.applied', compact('myInfo', 'jobsvip', 'companies'));
        }

        return redirect('/');
    }

    public function saveCV(Request $request){
        $input = $request->all();
        
        if (\Auth::check()) {
            $check = SaveCV::where('cv', '=', $input['cv_id'])->where('user', '=', \Auth::user()->id)->first();
            if(!isset($check)){
                $savecv = new SaveCV;
                $savecv->user = \Auth::user()->id;
                $savecv->cv = $input['cv_id'];
                $savecv->created_at = date("Y-m-d H:i:s");;
                if($savecv->save()){
                    return \Response::json(array('code' => '200', 'message' => 'success'));
                }else{
                    return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
                }
            }else{
                return \Response::json(array('code' => '200', 'message' => 'success'));
            }
        }else{
            return \Response::json(array('code' => '403', 'message' => 'unauthen'));
        }
    }

    public function jobcreated(){
        if (\Auth::check()) {
            $field = $district = $city = $job_type = $company = $cv = $vip = null;
            $from = 0;
            $number_get = 5;
            $jobGetObj = new Job;
            $user_id = \Auth::user()->id;
            $companyGetObj = new Company;

            $jobs = $jobGetObj->getJobCreatedByID($user_id);

            $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy("created_at", "DESC")->select('id', 'logo', 'name')->first();
            if($myInfo->logo == null) $myInfo->logo = \Auth::user()->avatar;

            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);

            return view('ntd.jobscreated', compact('myInfo', 'jobs', 'companies'));
        }
    }

    public function jobactive(){
        if (\Auth::check()) {
            $field = $district = $city = $job_type = $company = $cv = $vip = null;
            $from = 0;
            $number_get = 5;
            $jobGetObj = new Job;
            $user_id = \Auth::user()->id;
            $companyGetObj = new Company;
            $active = 1;

            $jobs = $jobGetObj->getJobCreatedByID($user_id, $active);

            $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy("created_at", "DESC")->select('id', 'logo', 'name')->first();
            if($myInfo->logo == null) $myInfo->logo = \Auth::user()->avatar;

            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);

            return view('ntd.jobsactive', compact('myInfo', 'jobs', 'companies'));
        }
    }

    public function jobinactive(){
        if (\Auth::check()) {
            $field = $district = $city = $job_type = $company = $cv = $vip = null;
            $from = 0;
            $number_get = 5;
            $jobGetObj = new Job;
            $user_id = \Auth::user()->id;
            $companyGetObj = new Company;
            $active = 1;

            $jobs = array();

            $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy("created_at", "DESC")->select('id', 'logo', 'name')->first();
            if($myInfo->logo == null) $myInfo->logo = \Auth::user()->avatar;

            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);

            return view('ntd.jobsinactive', compact('myInfo', 'jobs', 'companies'));
        }
    }

    public function jobexpired(){
        if (\Auth::check()) {
            $field = $district = $city = $job_type = $company = $cv = $vip = null;
            $from = 0;
            $number_get = 5;
            $jobGetObj = new Job;
            $user_id = \Auth::user()->id;
            $companyGetObj = new Company;
            $active = 2;

            $jobs = $jobGetObj->getJobCreatedByID($user_id, $active);

            $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy("created_at", "DESC")->select('id', 'logo', 'name')->first();
            if($myInfo->logo == null) $myInfo->logo = \Auth::user()->avatar;

            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);

            return view('ntd.jobsexpired', compact('myInfo', 'jobs', 'companies'));
        }
    }

    public function cvapplied(){
        $field = $district = $city = $job_type = $company = $cv = $vip = null;
        $from = 0;
        $number_get = 5;
        $jobGetObj = new Job;
        $active = 1;
        $status = 2; // 0 is new, 1 is viewed, 2 is applied

        if (\Auth::check()) {
            $user_id = \Auth::user()->id;
            $cvGetObj = new CurriculumVitae;
            $companyGetObj = new Company;

            $jobs = $jobGetObj->getJobCreatedByID($user_id, $active);


            if(count($jobs) > 0){
                $jobSelected = $jobs[0];
                $cvs = $cvGetObj->getCVAppliedByJobID($jobs[0]->id, $from, $number_get, $status);
            }else{
                $jobSelected = null;
                $cvs = array();
            }


            $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'logo', 'name')->first();
            if($myInfo->logo == null) $myInfo->logo = \Auth::user()->avatar;

            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);

            return view('ntd.cvapplied', compact('myInfo', 'cvs', 'jobSelected', 'jobs', 'companies'));
        }
    }

    public function getCVAppliedByJobID(Request $request){
        $input = $request->all();
        $field = $district = $city = $job_type = $company = $cv = $vip = null;
        $from = 0;
        $number_get = 5;
        $status = 2; // 0 is new, 1 is viewed, 2 is applied
        if (\Auth::check() && isset($input['job_id'])) {
            $cvGetObj = new CurriculumVitae;
            $cvs = $cvGetObj->getCVAppliedByJobID($input['job_id'], $from, $number_get, $status);
            return \Response::json(array('code' => '200', 'message' => 'success', 'cvs' => $cvs));
        }
        return \Response::json(array('code' => '403', 'message' => 'unauthen'));
    }

    public function cvappliednew(){
        $field = $district = $city = $job_type = $company = $cv = $vip = null;
        $from = 0;
        $number_get = 5;
        $jobGetObj = new Job;
        $active = 1;
        $status = 0; // 0 is new, 1 is viewed, 2 is applied

        if (\Auth::check()) {
            $user_id = \Auth::user()->id;
            $cvGetObj = new CurriculumVitae;
            $companyGetObj = new Company;

            $jobs = $jobGetObj->getJobCreatedByID($user_id, $active);


            if(count($jobs) > 0){
                $jobSelected = $jobs[0];
                $cvs = $cvGetObj->getCVAppliedByJobID($jobs[0]->id, $from, $number_get, $status);
            }else{
                $jobSelected = null;
                $cvs = array();
            }


            $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'logo', 'name')->first();
            if($myInfo->logo == null) $myInfo->logo = \Auth::user()->avatar;

            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);

            return view('ntd.cvappliednew', compact('myInfo', 'cvs', 'jobSelected', 'jobs', 'companies'));
        }
    }

    public function getCVAppliedNewByJobID(Request $request){
        $input = $request->all();
        $field = $district = $city = $job_type = $company = $cv = $vip = null;
        $from = 0;
        $number_get = 5;
        $status = 0; // 0 is new, 1 is viewed, 2 is applied
        if (\Auth::check() && isset($input['job_id'])) {
            $cvGetObj = new CurriculumVitae;
            $cvs = $cvGetObj->getCVAppliedByJobID($input['job_id'], $from, $number_get, $status);
            return \Response::json(array('code' => '200', 'message' => 'success', 'cvs' => $cvs));
        }
        return \Response::json(array('code' => '403', 'message' => 'unauthen'));
    }

    public function cvviewed(){
        $field = $district = $city = $job_type = $company = $cv = $vip = null;
        $from = 0;
        $number_get = 5;
        $jobGetObj = new Job;
        $active = 1;
        $status = 1; // 0 is new, 1 is viewed, 2 is applied

        if (\Auth::check()) {
            $user_id = \Auth::user()->id;
            $cvGetObj = new CurriculumVitae;
            $companyGetObj = new Company;

            $jobs = $jobGetObj->getJobCreatedByID($user_id, $active);


            if(count($jobs) > 0){
                $jobSelected = $jobs[0];
                $cvs = $cvGetObj->getCVAppliedByJobID($jobs[0]->id, $from, $number_get, $status);
            }else{
                $jobSelected = null;
                $cvs = array();
            }


            $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'logo', 'name')->first();
            if($myInfo->logo == null) $myInfo->logo = \Auth::user()->avatar;

            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);

            return view('ntd.cvappliedviewed', compact('myInfo', 'cvs', 'jobSelected', 'jobs', 'companies'));
        }
    }

    public function getCVAppliedViewedByJobID(Request $request){
        $input = $request->all();
        $field = $district = $city = $job_type = $company = $cv = $vip = null;
        $from = 0;
        $number_get = 5;
        $status = 1; // 0 is new, 1 is viewed, 2 is applied
        if (\Auth::check() && isset($input['job_id'])) {
            $cvGetObj = new CurriculumVitae;
            $cvs = $cvGetObj->getCVAppliedByJobID($input['job_id'], $from, $number_get, $status);
            return \Response::json(array('code' => '200', 'message' => 'success', 'cvs' => $cvs));
        }
        return \Response::json(array('code' => '403', 'message' => 'unauthen'));
    }

    public function cvsaved(){

        $user_id = \Auth::user()->id;
        $district = $city = $field = null;
        $from = 0;
        $number_get = 10;

        if (\Auth::check()) {
            $cvGetObj = new CurriculumVitae;
            $companyGetObj = new Company;
            $cvssaved = $cvGetObj->getCVSaved($user_id, $from, $number_get);
            $cvs = $cvssaved;

            $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'logo', 'name')->first();
            if($myInfo->logo == null) $myInfo->logo = \Auth::user()->avatar;

            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);

            return view('ntd.main', compact('myInfo', 'cvssaved', 'companies', 'cvs'));
        }
    }

    public function cvsuggest(){
        $field = $district = $city = $job_type = $company = $cv = $vip = null;
        $from = 0;
        $number_get = 5;
        $jobGetObj = new Job;
        $active = 1;
        $status = 0; // 0 is new, 1 is viewed, 2 is applied

        if (\Auth::check()) {
            $user_id = \Auth::user()->id;
            $cvGetObj = new CurriculumVitae;
            $companyGetObj = new Company;

            $jobs = $jobGetObj->getJobCreatedByID($user_id, $active);


            if(count($jobs) > 0){
                $jobSelected = $jobs[0];
                $cvs = $cvGetObj->getCVAppliedByJobID($jobs[0]->id, $from, $number_get, $status);
            }else{
                $jobSelected = null;
                $cvs = array();
            }

            $myInfo = Company::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'logo', 'name')->first();
            if($myInfo->logo == null) $myInfo->logo = \Auth::user()->avatar;

            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);

            return view('ntd.cvappliednew', compact('myInfo', 'cvs', 'jobSelected', 'jobs', 'companies'));
        }
    }

    public function removeApplied(Request $request){
        $input = $request->all();
        if (\Auth::check()) {
            $apply = Apply::where("user", "=", $input['user_id'])->where("job", "=", $input['job_id'])->first();
            $apply->active = -1; // removed
            if($apply->save()){
                return \Response::json(array('code' => '200', 'message' => 'success'));
            }
            return \Response::json(array('code' => '201', 'message' => 'unsuccess'));
        }
        return \Response::json(array('code' => '403', 'message' => 'unauthen'));
    }

    public function removeSaved(Request $request){
        $input = $request->all();
        if (\Auth::check()) {
            $apply = SaveCV::where("cv", "=", $input['cv_id'])->where("user", "=", \Auth::user()->id)->first();
            if($apply->delete()){
                return \Response::json(array('code' => '200', 'message' => 'success'));
            }
            return \Response::json(array('code' => '201', 'message' => 'unsuccess'));
        }
        return \Response::json(array('code' => '403', 'message' => 'unauthen'));
    }

    public function changeToViewed(Request $request){
        $input = $request->all();
        if (\Auth::check()) {
            $apply = Apply::where("user", "=", $input['user_id'])->where("job", "=", $input['job_id'])->first();
            $apply->active = 1; // viewed
            if($apply->save()){
                return \Response::json(array('code' => '200', 'message' => 'success'));
            }
            return \Response::json(array('code' => '201', 'message' => 'unsuccess'));
        }
        return \Response::json(array('code' => '403', 'message' => 'unauthen'));
    }

    public function test(){
        $dataUser = array('email'=>'tran.thanh.tuan269@gmail.com', 'name'=>'tran thanh tuan');
        // Mail::send('emails.welcomeNew', [], function($message) use ($dataUser) {
        //     $message->from('support@gmon.com.vn', 'gmon.com.vn');
        //     $message->to($dataUser['email'], $dataUser['name'])->subject('Gmon.vn thông báo đăng ký thành công!');
        // });

        $jobs = array();
        $jobs[0] = array();
        $jobs[0]['name'] = "Tran Thanh Tuan 2";

        Mail::to('tran.thanh.tuan269@gmail.com')->send(new JobSuggest($jobs));
    }
}
