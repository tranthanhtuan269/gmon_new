<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\District;
use App\City;
use App\Job;
use App\Company;
use App\CurriculumVitae;
use Illuminate\Http\Request;
use Session;
use DB;

class DistrictController extends Controller
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
            $district = District::where('name', 'LIKE', "%$keyword%")
				->orWhere('city', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $district = DB::table('districts')
            ->join('cities', 'cities.id', '=', 'districts.city')
            ->select('districts.id', 'districts.name', 'cities.name as city', 'districts.active')
            ->paginate($perPage);
        }

        return view('district.index', compact('district'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = City::pluck('name', 'id');
        return view('district.create', compact('cities'));
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
			'name' => 'required',
			'city' => 'required'
		]);
        $requestData = $request->all();
        
        District::create($requestData);

        Session::flash('flash_message', 'District added!');

        return redirect('admin/district');
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
        $district = District::findOrFail($id);
        $city = City::findOrFail($district->city);
        return view('district.show', compact('district', 'city'));
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
        $district = District::findOrFail($id);
        $cities = City::pluck('name', 'id');
        return view('district.edit', compact('district', 'cities'));
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
			'name' => 'required',
			'city' => 'required'
		]);
        $requestData = $request->all();
        
        $district = District::findOrFail($id);
        $district->update($requestData);

        Session::flash('flash_message', 'District updated!');

        return redirect('admin/district');
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
        District::destroy($id);

        Session::flash('flash_message', 'District deleted!');

        return redirect('admin/district');
    }

    public function admin()
    {
        $perPage = 10;

        $districts = \DB::table('districts')
            ->join('cities', 'cities.id', '=', 'districts.city')
            ->where('cities.active', '=', 1)
            ->select('districts.id as id', 'districts.name as name', 'districts.active as active', 'cities.name as city')
            ->paginate($perPage);
        return view('district.admin', compact('districts'));
    }

    public function active(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['district'])){
            $district = District::findOrFail($input['district']);
            $district->active = 1;
            if($district->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unactive(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['district'])){
            $district = District::findOrFail($input['district']);
            $district->active = 0;
            if($district->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function getAllSlug($id, $slug = null)
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
        $district = $id;
        $districtObj = \App\District::findOrFail($id);
        $meta_title = 'Tìm việc tại ' . $districtObj->name;
        $meta_description = 'Tìm việc tại ' . $districtObj->name;
        $meta_keyword = 'Tìm việc, ' . $districtObj->name;
        // get district of city
        $districts = \DB::table('districts')
                    ->where('districts.city', '=', $districtObj->city)
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
}
