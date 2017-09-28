<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
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
            $category = Category::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $category = Category::paginate($perPage);
        }

        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('category.create');
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
        
        $requestData = $request->all();
        
        Category::create($requestData);

        Session::flash('flash_message', 'Category added!');

        return redirect('master/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function getCategory($id, $slug)
    {
        $categories = [];
        $jobs = [];
        $companies = [];

        $company_id = -1;
        $cv_id = -1;
        $perPage = 1000;
        $number_get = 10;
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;
            
            //get company 
            $company = \DB::table('companies')
                    ->where('companies.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($company){
                $company_id = $company->id;
            }
            
            //get CV 
            $cv_user = \DB::table('curriculum_vitaes')
                    ->where('curriculum_vitaes.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($cv_user){
                $cv_id = $cv_user->id;
            }
        }

        $partners = \App\Partner::take(4)->get();

        $categories = \DB::table('categories')
            ->select('id', 'name', 'slug')
            ->get();

        $post = new \App\Post;
        $posts = $post->getPosts($id, null, 0, $number_get);

        $slug_url = "";
        $category_selected = \App\Category::find($id);
        if(isset($category_selected)){
            $slug_url = $category_selected->name . ' - ' . $category_selected->description;
        }

        $companies = \DB::table('companies')
            ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
            ->where('company_company_types.company_type', '=', 5)
            ->select('companies.id', 'companies.logo', 'companies.banner', 'companies.name', 'companies.slug')
            ->take(5)
            ->get();

        $jobs = \DB::table('jobs')
            ->join('companies', 'companies.id', '=', 'jobs.company')
            ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
            ->where('company_company_types.company_type', '=', 5)
            ->select('companies.logo', 'companies.banner', 'jobs.name', 'companies.name as companyName', 'jobs.id', 'jobs.slug')
            ->take(5)
            ->get();

        return view('category.show', compact('slug_url', 'id', 'categories', 'companies', 'jobs', 'posts', 'company_id', 'cv_id', 'partners'));
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
        $categories = [];
        $jobs = [];
        $companies = [];

        $company_id = -1;
        $cv_id = -1;
        $perPage = 1000;
        $number_get = 5;
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;
            
            //get company 
            $company = \DB::table('companies')
                    ->where('companies.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($company){
                $company_id = $company->id;
            }
            
            //get CV 
            $cv_user = \DB::table('curriculum_vitaes')
                    ->where('curriculum_vitaes.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($cv_user){
                $cv_id = $cv_user->id;
            }
        }

        $partners = \App\Partner::take(4)->get();

        $categories = \DB::table('categories')
            ->select('id', 'name', 'slug')
            ->get();

        $post = new \App\Post;
        $posts = $post->getPosts($id, null, 0, $number_get);

        $slug_url = "";
        $category_selected = \App\Category::find($id);
        if(isset($category_selected)){
            $slug_url = $category_selected->name . ' - ' . $category_selected->description;
        }

        $companies = \DB::table('companies')
            ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
            ->where('company_company_types.company_type', '=', 5)
            ->select('companies.id', 'companies.logo', 'companies.banner', 'companies.name', 'companies.slug')
            ->take(5)
            ->get();

        $jobs = \DB::table('jobs')
            ->join('companies', 'companies.id', '=', 'jobs.company')
            ->join('company_company_types', 'company_company_types.company', '=', 'companies.id')
            ->where('company_company_types.company_type', '=', 5)
            ->select('companies.logo', 'companies.banner', 'jobs.name', 'companies.name as companyName', 'jobs.id', 'jobs.slug')
            ->take(5)
            ->get();
        return view('category.show', compact('slug_url', 'categories', 'companies', 'jobs', 'posts', 'company_id', 'cv_id', 'partners'));
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
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
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
        
        $requestData = $request->all();
        
        $category = Category::findOrFail($id);
        $category->update($requestData);

        Session::flash('flash_message', 'Category updated!');

        return redirect('master/category');
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
        Category::destroy($id);

        Session::flash('flash_message', 'Category deleted!');

        return redirect('master/category');
    }
}
