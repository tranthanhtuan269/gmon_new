<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Apply;
use Illuminate\Http\Request;
use Session;

class ApplyController extends Controller
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
            $apply = Apply::where('user', 'LIKE', "%$keyword%")
				->orWhere('job', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $apply = Apply::paginate($perPage);
        }

        return view('apply.index', compact('apply'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('apply.create');
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
			'user' => 'required',
			'job' => 'required'
		]);
        $requestData = $request->all();
        
        Apply::create($requestData);

        Session::flash('flash_message', 'Apply added!');

        return redirect('apply');
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
        $apply = Apply::findOrFail($id);

        return view('apply.show', compact('apply'));
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
        $apply = Apply::findOrFail($id);

        return view('apply.edit', compact('apply'));
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
			'user' => 'required',
			'job' => 'required'
		]);
        $requestData = $request->all();
        
        $apply = Apply::findOrFail($id);
        $apply->update($requestData);

        Session::flash('flash_message', 'Apply updated!');

        return redirect('apply');
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
        Apply::destroy($id);

        Session::flash('flash_message', 'Apply deleted!');

        return redirect('apply');
    }

    public function admin()
    {
        $perPage = 10;

        $apply = \DB::table('applies')
            ->join('users', 'users.id', '=', 'applies.user')
            ->join('jobs', 'jobs.id', '=', 'applies.job')
            ->select('applies.id as id', 'users.name as user', 'jobs.name as job')
            ->paginate($perPage);

        var_dump($apply);die;
        return view('apply.admin', compact('apply'));
    }
}
