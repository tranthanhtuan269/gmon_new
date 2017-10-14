<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\City;
use App\Job;
use App\Company;
use App\CurriculumVitae;
use Illuminate\Http\Request;
use Session;

class CityController extends Controller
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
            $city = City::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $city = City::paginate($perPage);
        }

        return view('city.index', compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('city.create');
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        City::create($requestData);

        Session::flash('flash_message', 'City added!');

        return redirect('admin/city');
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
        $city = City::findOrFail($id);

        return view('city.show', compact('city'));
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
        $city = City::findOrFail($id);

        return view('city.edit', compact('city'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $city = City::findOrFail($id);
        $city->update($requestData);

        Session::flash('flash_message', 'City updated!');

        return redirect('admin/city');
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
        City::destroy($id);

        Session::flash('flash_message', 'City deleted!');

        return redirect('admin/city');
    }

    public function admin()
    {
        $perPage = 10;
        $city = City::paginate($perPage);
        return view('city.admin', compact('city'));
    }

    public function getAll($id)
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
        $district = $city = $job_type = $company = $cv = $vip = $from = $number_get = null;
        $from  = 0;
        $number_get = 10;
        $field = 5;

        $city = $id;

        $cityObj = \App\City::findOrFail($id);

        $meta_title = 'Tìm việc tại ' . $cityObj->name;
        $meta_description = 'Tìm việc tại ' . $cityObj->name;
        $meta_keyword = 'Tìm việc, ' . $cityObj->name;

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

        // get company of vip
        $cvs = $cvGetObj->getCV($district, $city, $from, 10);

        // get cv of vip
        $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

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

        return view('welcome', compact('jobcount0', 'jobcount1', 'jobcount2', 'jobcount3', 'cvcount' ,'districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'partners', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function getAllSlug($id, $slug)
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
        $district = $city = $job_type = $company = $cv = $vip = $from = $number_get = null;
        $from  = 0;
        $number_get = 10;
        $field = 5;

        $city = $id;

        $cityObj = \App\City::findOrFail($id);

        $meta_title = 'Tìm việc tại ' . $cityObj->name;
        $meta_description = 'Tìm việc tại ' . $cityObj->name;
        $meta_keyword = 'Tìm việc, ' . $cityObj->name;

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

        // get company of vip
        $cvs = $cvGetObj->getCV($district, $city, $from, 10);

        // get cv of vip
        $companies = $companyGetObj->getCompany($district, $city, $field, $from, 20);

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

        return view('welcome', compact('jobcount0', 'jobcount1', 'jobcount2', 'jobcount3', 'cvcount' ,'districts', 'city', 'cvs', 'jobs', 'jobsvip1', 'jobsvip2', 'companies', 'company_id', 'cv_id', 'partners', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function active(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['city'])){
            $city = City::findOrFail($input['city']);
            $city->active = 1;
            if($city->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unactive(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['city'])){
            $city = City::findOrFail($input['city']);
            $city->active = 0;
            if($city->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }
}
