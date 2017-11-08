<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CurriculumVitae;
use App\CommentCurriculumVitae;
use App\Company;
use App\Job;
use App\User;
use App\Salary;
use Illuminate\Http\Request;
use Session;
// use Carbon\Carbon;

class CurriculumVitaeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $curriculumvitae =\DB::table('curriculum_vitaes')
                ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                ->where('users.name', 'like', "%$keyword%")
                ->select('curriculum_vitaes.id', 'curriculum_vitaes.avatar', 'curriculum_vitaes.vip', 'users.name', 'users.phone as phone', 'users.email as email')
                ->orderby('curriculum_vitaes.created_at', 'desc')
				->paginate($perPage);
        } else {
            $curriculumvitae = \DB::table('curriculum_vitaes')
                ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                ->select('curriculum_vitaes.id', 'curriculum_vitaes.avatar', 'curriculum_vitaes.vip', 'users.name', 'users.phone as phone', 'users.email as email')
                ->orderby('curriculum_vitaes.created_at', 'desc')->paginate($perPage);
        }

        return view('curriculum-vitae.index', compact('curriculumvitae'));
    }


    public function indexCurriculumVitae(Request $request)
    {
        $curriculumvitaes = \DB::table('curriculum_vitaes')
                ->join('cities', 'cities.id', '=', 'curriculum_vitaes.city')
                ->join('districts', 'districts.id', '=', 'curriculum_vitaes.district')
                ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                ->select(
                        'curriculum_vitaes.id', 
                        'curriculum_vitaes.avatar', 
                        'curriculum_vitaes.birthday', 
                        'curriculum_vitaes.gender', 
                        'users.name as name', 
                        'curriculum_vitaes.address', 
                        'cities.name as city', 
                        'districts.name as district', 
                        'curriculum_vitaes.education', 
                        'curriculum_vitaes.school', 
                        'curriculum_vitaes.word_experience', 
                        'curriculum_vitaes.language', 
                        'curriculum_vitaes.interests', 
                        'curriculum_vitaes.references', 
                        'curriculum_vitaes.qualification', 
                        'curriculum_vitaes.career_objective', 
                        'curriculum_vitaes.images', 
                        'curriculum_vitaes.active', 
                        'curriculum_vitaes.updated_at' 
                )
                ->take(30)
                ->orderby('curriculum_vitaes.created_at', 'desc')
                ->get();

        $curriculumvitaes2 = \DB::table('curriculum_vitaes')
                ->join('cities', 'cities.id', '=', 'curriculum_vitaes.city')
                ->join('districts', 'districts.id', '=', 'curriculum_vitaes.district')
                ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                ->select(
                        'curriculum_vitaes.id', 
                        'curriculum_vitaes.avatar',
                        'users.name as name', 
                        'curriculum_vitaes.school',
                        'curriculum_vitaes.updated_at' 
                )
                ->take(5)
                ->orderby('curriculum_vitaes.created_at', 'desc')
                ->get();

        return view('curriculum-vitae.index_curriculum_vitae', compact('curriculumvitaes', 'curriculumvitaes2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('curriculum-vitae.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {        
        $this->validate($request, [
			'user' => 'required'
		]);
        $requestData = $request->all();
        
        CurriculumVitae::create($requestData);

        Session::flash('flash_message', 'CurriculumVitae added!');

        return redirect('admin/curriculum-vitae');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateCurriculumVitae($id, Request $request)
    {        
        $input = $request->all();

        unset($input['images-img']);
        unset($input['bang_cap_0']);
        unset($input['student_process_0']);

        $user = \Auth::user();
        $userCheck = User::Where('email', $input['email'])->first();
        $user->name = $input['name'];
        if(!$userCheck){
            $user->email = $input['email'];
        }
        $user->phone = $input['phone'];
        $user->save();

        $input['images'] = $request['images-plus-field'];
        $input['time_can_work'] = $request['time_can_work'];
        $input['jobs'] = $request['jobs'];
        $input['salary_want'] = $request['salary_want'];
        $input['user'] = \Auth::user()->id;
        $input['updated_at'] = date("Y-m-d H:i:s");

        $curriculumvitae = CurriculumVitae::findOrFail($id);

        if ($curriculumvitae) {
            $curriculumvitae->update($input);
            return redirect()->action(
                    'CurriculumVitaeController@showCurriculumVitae', ['id' => $curriculumvitae->id]
                );
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $curriculumvitae = CurriculumVitae::findOrFail($id);

        return view('curriculum-vitae.show', compact('curriculumvitae'));
    }

    public function showCurriculumVitae($id)
    {
        $mine_cv = 0;
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
        }
        $curriculumvitae = CurriculumVitae::findOrFail($id);
        $user = User::findOrFail($curriculumvitae->user);
        $curriculumvitae = \DB::table('curriculum_vitaes')
                ->join('cities', 'cities.id', '=', 'curriculum_vitaes.city')
                ->join('districts', 'districts.id', '=', 'curriculum_vitaes.district')
                ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                ->select(
                        'curriculum_vitaes.id', 
                        'curriculum_vitaes.avatar as avatarCV', 
                        'users.avatar as avatarU', 
                        'curriculum_vitaes.birthday', 
                        'curriculum_vitaes.gender', 
                        'users.name as name', 
                        'curriculum_vitaes.address', 
                        'cities.name as city', 
                        'districts.name as district', 
                        'curriculum_vitaes.education', 
                        'curriculum_vitaes.word_experience', 
                        'curriculum_vitaes.language', 
                        'curriculum_vitaes.interests', 
                        'curriculum_vitaes.references', 
                        'curriculum_vitaes.qualification', 
                        'curriculum_vitaes.career_objective', 
                        'curriculum_vitaes.images', 
                        'curriculum_vitaes.active', 
                        'curriculum_vitaes.user', 
                        'curriculum_vitaes.updated_at' 
                )
                ->where('curriculum_vitaes.id', $id)
                ->first();

        $commentCurriculumVitaes = \DB::table('comment_curriculum_vitaes')->where('curriculumvitae', $id)->get();

        return view('curriculum-vitae.show-curriculum-vitae', compact('curriculumvitae', 'user', 'company_id', 'cv_id', 'commentCurriculumVitaes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $mine_cv = 0;
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
        }

        $curriculumvitae = CurriculumVitae::findOrFail($id);

        return view('curriculum-vitae.edit', compact('curriculumvitae', 'company_id', 'cv_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
			'user' => 'required'
		]);
        $requestData = $request->all();
        
        $curriculumvitae = CurriculumVitae::findOrFail($id);
        $curriculumvitae->update($requestData);

        Session::flash('flash_message', 'CurriculumVitae updated!');

        return redirect('admin/curriculum-vitae');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        CurriculumVitae::destroy($id);

        Session::flash('flash_message', 'CurriculumVitae deleted!');

        return redirect('admin/curriculum-vitae');
    }
    
    public function createCurriculumVitae() {
        if (\Auth::check()) {
            // if check exist CV then goto update CV

            $salaries = Salary::select('name', 'id')->get();
            $company_id = -1;
            $cv_id = -1;
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
            if($cv_id != -1){
                return redirect('curriculumvitae/'.$cv_id.'/edit');
            }
            
            $cities = \App\City::pluck('name', 'id');
            $districts = \App\District::pluck('name', 'id');
            $salaries = \App\Salary::pluck('name', 'id');
            $job_types = \App\JobType::pluck('name', 'id');
            $months = array('0' => '--Chọn Tháng--');
            for($i = 1; $i <= 12; $i++){
                $months[$i] = 'Tháng ' . $i;
            }
            
            $years = array('0' => '--Chọn Năm--');
            for($i = 2017; $i >= 1961; $i--){
                $years[$i] = 'Năm ' . $i;
            }

            $loaitotnghieps = array('0' => 'Chọn Loại tốt nghiệp');
            $loaitotnghieps[] = 'Xuất sắc';
            $loaitotnghieps[] = 'Giỏi';
            $loaitotnghieps[] = 'Khá';
            $loaitotnghieps[] = 'Trung bình khá';
            $loaitotnghieps[] = 'Trung bình';
            return view('curriculum-vitae.create_curriculum_vitae', compact('company_id', 'cv_id', 'salaries', 'cities', 'districts', 'salaries', 'months', 'years', 'job_types', 'loaitotnghieps'));
        }

        return view('errors.404');
    }
    
    public function editCurriculumVitae($id) {
        $mine_cv = 0;
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];

            $current_id = $user_info['user_id'];
            
            $cities = \App\City::pluck('name', 'id');
            $districts = \App\District::pluck('name', 'id');
            $towns = \App\Town::pluck('name', 'id');
            $salaries = \App\Salary::pluck('name', 'id');
            $job_types = \App\JobType::pluck('name', 'id');
            
            $months = array('0' => '--Chọn Tháng--');
            for($i = 1; $i <= 12; $i++){
                $months[$i] = 'Tháng ' . $i;
            }
            
            $years = array('0' => '--Chọn Năm--');
            for($i = 1961; $i <= 2017; $i++){
                $years[$i] = 'Năm ' . $i;
            }
            
            $loaitotnghieps = array('0' => 'Chọn Loại tốt nghiệp');
            $loaitotnghieps[] = 'Xuất sắc';
            $loaitotnghieps[] = 'Giỏi';
            $loaitotnghieps[] = 'Khá';
            $loaitotnghieps[] = 'Trung bình khá';
            $loaitotnghieps[] = 'Trung bình';

            $time_can_works = array('0' => '--Chọn Thời gian làm việc--');
            $time_can_works[] = 'Ca 1 (7h - 12h)';
            $time_can_works[] = 'Ca 2 (12h - 17h)';
            $time_can_works[] = 'Ca 3 (17h - 22h)';
            $time_can_works[] = 'Fulltime';

            //get CV 
            $cv_user = \DB::table('curriculum_vitaes')
                    ->join('cities', 'cities.id', '=', 'curriculum_vitaes.city')
                    ->join('districts', 'districts.id', '=', 'curriculum_vitaes.district')
                    ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                    ->select(
                            'curriculum_vitaes.id', 
                            'curriculum_vitaes.avatar as avatarCV', 
                            'users.avatar as avatarU', 
                            'curriculum_vitaes.birthday', 
                            'curriculum_vitaes.salary_want', 
                            'curriculum_vitaes.gender', 
                            'users.name as name', 
                            'curriculum_vitaes.address', 
                            'cities.id as city_id', 
                            'cities.name as city', 
                            'districts.id as district_id', 
                            'districts.name as district', 
                            'curriculum_vitaes.education', 
                            'curriculum_vitaes.word_experience', 
                            'curriculum_vitaes.language', 
                            'curriculum_vitaes.interests', 
                            'curriculum_vitaes.references', 
                            'curriculum_vitaes.qualification', 
                            'curriculum_vitaes.career_objective', 
                            'curriculum_vitaes.time_can_work', 
                            'curriculum_vitaes.jobs', 
                            'curriculum_vitaes.images', 
                            'curriculum_vitaes.active', 
                            'curriculum_vitaes.updated_at' 
                    )
                    ->where('curriculum_vitaes.user', $current_id)
                    ->where('curriculum_vitaes.id', $id)
                    ->first();
            
            if($cv_user == NULL){
                return view('errors.404');
            }
            return view('curriculum-vitae.edit_curriculum_vitae', compact('cv_user', 'cities', 'districts', 'towns', 'months', 'years', 'loaitotnghieps', 'company_id', 'cv_id', 'salaries', 'job_types', 'time_can_works'));
        }else{
            return view('errors.404');
        }
    }
    
    public function storeCurriculumVitae(Request $request) {
        $input = $request->all();

        unset($input['images-img']);
        unset($input['bang_cap_0']);
        unset($input['student_process_0']);

        $user = \Auth::user();
        $userCheck = User::Where('email', $input['email'])->first();
        $user->name = $input['name'];
        if(!$userCheck){
            $user->email = $input['email'];
        }
        $user->phone = $input['phone'];
        $user->save();

        $input['images'] = $request['images-plus-field'];
        $input['time_can_work'] = $request['time_can_work'];
        $input['jobs'] = $request['jobs'];
        $input['salary_want'] = $request['salary'];
        
        $input['user'] = \Auth::user()->id;
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['updated_at'] = date("Y-m-d H:i:s");
        
        $curriculumVitae = CurriculumVitae::create($input);

        if ($curriculumVitae) {
            $jobTypeGetObj = new \App\JobType;
            $jobsID = $jobTypeGetObj->getIDByName($input['jobs']);

            $jobGetObj = new Job;
            $jtse = $jobGetObj->getJobRelative($input['district'], $input['city'], $input['salary_want'], $jobsID, 0, 5);
            if(isset($user->email) && strlen($user->email) > 3){
                \Mail::to($user->email)->send(new \App\Mail\JobSuggest($jtse));
            }
            return redirect()->action(
                    'CurriculumVitaeController@showCurriculumVitae', ['id' => $curriculumVitae->id]
                );
        }

        return redirect()->back();
    }

    public function sendcomment(Request $request) {
        if (\Auth::check()) {
            $input = $request->all();
            $current_id = \Auth::user()->id;

            // check exist comment of user
            $commentExist = CommentCurriculumVitae::where('created_by', $current_id)->where('curriculumvitae', $input['curriculumvitae'])->first();

            if ($commentExist)
                return \Response::json(array('code' => '404', 'message' => 'Bạn chỉ được gửi đánh giá 1 lần với Ứng viên này!'));

            // store
            $comment = new CommentCurriculumVitae;
            $comment->description = $input['description'];
            $comment->star = $input['countStar'];
            $comment->curriculumvitae = $input['curriculumvitae'];
            $comment->created_by = $current_id;
            $comment->created_at = date("Y-m-d H:i:s");

            if ($comment->save()) {
                return \Response::json(array('code' => '200', 'message' => 'success', 'comment' => $comment));
            }
            return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
        }else{
            return \Response::json(array('code' => '403', 'message' => 'unauthen'));
        }
    }

    public function vip(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['cv'])){
            $cv = CurriculumVitae::findOrFail($input['cv']);
            $cv->active = 1;
            if($cv->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unvip(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['cv'])){
            $cv = CurriculumVitae::findOrFail($input['cv']);
            $cv->active = 0;
            if($cv->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function getCV(){
        $cvGetObj = new CurriculumVitae;
        $district = $city = $field = $job_type = $company = $cv = $vip = $from = $number_get = null;
        $number_get = 20;
        if(isset($_GET)){

            if(isset($_GET['start']) && $_GET['start'] > 0){
                $from = $_GET['start'];
            }

            if(isset($_GET['number']) && $_GET['number'] > 0){
                $number_get = $_GET['number'];
            }

            if(isset($_GET['city']) && $_GET['city'] > 0){
                $city = $_GET['city'];
            }

            if(isset($_GET['district']) && $_GET['district'] > 0){
                $district = $_GET['district'];
            }

            $cvs = $cvGetObj->getCV($district, $city, $from, $number_get);
            return \Response::json(array('code' => '200', 'message' => 'Success!', 'cvs' => $cvs));
        }
    }

    public function usercreateCV(){
        if (\Auth::check()) {

            $jobGetObj = new Job;
            $field = $district = $city = $job_type = $company = $cv = $vip = null;
            $from = 0;
            $number_get = 5;

            
            $companyGetObj = new Company;

            // get info User
            $myInfo = CurriculumVitae::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'avatar', 'school')->first();
            if(isset($myInfo)) $myInfo->avatar = \Auth::user()->avatar;

            $jobsvip = $jobGetObj->getJobWithBanner($from, 5);
            $companies = $companyGetObj->getCompany($district, $city, $field, $from, $number_get);
            return view('uv.createCV', compact('myInfo', 'jobsvip', 'companies'));
        }

        return redirect('/');
    }

    public function userupdateCV(){
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
}
