<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
  
Auth::routes();

// Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/', 'HomeController@homenew2')->name('welcome');
Route::get('/google2fa952a6c07ee729.html', function(){
    echo 'google-site-verification: google2fa952a6c07ee729.html';
});

Route::get('/user/main', 'HomeController@usermain');
Route::get('/user/createCV', 'CurriculumVitaeController@usercreateCV');
Route::get('/user/updateCV', 'CurriculumVitaeController@userupdateCV');
Route::get('/user/applied', 'JobController@userapplied');
Route::get('/user/jobrelative', 'JobController@userJobRelative');
Route::get('/user/companyfollow', 'CompanyController@usercompanyfollow');
Route::get('/user/companynew', 'CompanyController@usercompanynew');
Route::get('/getJobApply', 'JobController@getJobApply');
Route::get('/getJobRelative', 'JobController@getJobRelative');
Route::get('/getCompanyFollowed', 'CompanyController@getCompanyFollowed');
Route::get('/getCompanyNew', 'CompanyController@getCompanyNew');

Route::post('/refreshJob', 'JobController@refreshJob');
Route::post('/removeJob', 'JobController@removeJob');
Route::get('/user/jobcreated', 'HomeController@jobcreated');
Route::get('/user/jobactive', 'HomeController@jobactive');
Route::get('/user/jobinactive', 'HomeController@jobinactive');
Route::get('/user/jobexpired', 'HomeController@jobexpired');

Route::get('/user/cvapplied', 'HomeController@cvapplied');
Route::get('/user/cvappliednew', 'HomeController@cvappliednew');
Route::get('/user/cvviewed', 'HomeController@cvviewed');
Route::get('/user/cvsaved', 'HomeController@cvsaved');
Route::get('/user/cvsuggest', 'HomeController@cvsuggest');
Route::get('/test', 'HomeController@test');
Route::get('/testnew', 'HomeController@testnew');
Route::post('/curriculumvitae/saveCV', 'HomeController@saveCV');
Route::post('/removeApplied', 'HomeController@removeApplied');
Route::post('/removeSaved', 'HomeController@removeSaved');
Route::post('/changeToViewed', 'HomeController@changeToViewed');
Route::get('/getCVAppliedOfJob', 'HomeController@getCVAppliedByJobID');
Route::get('/getCVAppliedNewOfJob', 'HomeController@getCVAppliedNewByJobID');
Route::get('/getCVAppliedViewedOfJob', 'HomeController@getCVAppliedViewedByJobID');





Route::resource('/branch', 'BranchController');
Route::get('/hello', 'HomeController@homenew2');
Route::get('/welcome', 'HomeController@homenew');
Route::get('/showmore', 'HomeController@showmore')->name('showmore');
Route::get('/home', 'HomeController@welcome')->name('home');

Route::get('/auth/facebook', 'Auth\RegisterController@redirectToFacebook');
Route::get('/auth/facebook/callback', 'Auth\RegisterController@handleFacebookCallback');
Route::get('/auth/google', 'Auth\RegisterController@redirectToGoogle');
Route::get('/auth/google/callback', 'Auth\RegisterController@handleGoogleCallback');
Route::post('/auth/login', 'SiteController@loginApi');
Route::post('/auth/register', 'SiteController@registerApi');

Route::get('/curriculumvitae', 'CurriculumVitaeController@indexCurriculumVitae');
Route::get('/curriculumvitae/view/{id}', 'CurriculumVitaeController@showCurriculumVitae');
Route::get('/job/view/{id}', 'JobController@info');
Route::get('/getJob/', 'JobController@getJob');
Route::get('/getJobWithBanner/', 'JobController@getJobWithBanner');
Route::get('/getCompany/', 'CompanyController@getCompany');
Route::get('/getCV/', 'CurriculumVitaeController@getCV');

Route::post('/job/join', 'JobController@join');
Route::get('/company/{id}/info', 'CompanyController@info');
Route::get('/company/{id}/listjobs', 'CompanyController@listjobs');
Route::get('/getDistrict/{id}', 'HomeController@getDistrict');
Route::get('/getDistrictli/{id}', 'HomeController@getDistrictLi');
Route::get('/getTown/{id}', 'HomeController@getTown');

Route::get('privacy-policy', 'HomeController@privacypolicy');
Route::get('terms-of-service', 'HomeController@termsofservice');
Route::get('support', 'HomeController@support');
Route::post('ajaxpro', 'HomeController@ajaxpro');
Route::get('sendemail', 'HomeController@sendemail');

Route::group(['middleware' => 'auth'], function(){

    Route::post('send-comment', 'CompanyController@sendcomment');

    // Check role in route middleware
    Route::get('curriculumvitae/create', 'CurriculumVitaeController@createCurriculumVitae');
    Route::get('curriculumvitae/{id}/edit', 'CurriculumVitaeController@editCurriculumVitae');
    Route::post('curriculumvitae/update/{id}', 'CurriculumVitaeController@updateCurriculumVitae');
    Route::post('curriculumvitae/store', 'CurriculumVitaeController@storeCurriculumVitae');
    Route::post('/postImage', 'HomeController@postImage');
    Route::post('/postImages', 'HomeController@postImages');
    Route::post('/curriculumvitae/send-comment', 'CurriculumVitaeController@sendcomment');
    Route::post('/follow-company', 'CompanyController@follow');
    Route::post('/unfollow-company', 'CompanyController@unfollow');
});

// Check role in route middleware
Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'poster'], function () {
    Route::get('company/create', 'CompanyController@createCompany');
    Route::post('company/store', 'CompanyController@storeCompany');
    Route::get('company/editCompany', 'CompanyController@editCompany');
    Route::post('company/update', 'CompanyController@updateCompany');
    Route::get('company/create_v2', 'CompanyController@createCompany_v2');
    Route::post('company/store_v2', 'CompanyController@storeCompany_v2');
    Route::get('job/create', 'JobController@createJob');
    Route::post('job/store', 'JobController@storeJob');
    Route::get('job/{id}/editJob', 'JobController@editJob');
    Route::post('job/{id}/update', 'JobController@updateJob');
    Route::post('/curriculumvitae/send-comment', 'CurriculumVitaeController@sendcomment');
    Route::get('company/{id}/view01', 'CompanyController@view01');
    Route::get('company/{id}/view02', 'CompanyController@view02');
    Route::get('company/{id}/view03', 'CompanyController@view03');
    Route::post('company/changeTemplate', 'CompanyController@changeTemplate');
});

// Check role in route middleware
Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
    Route::get('admin', 'Admin\AdminController@index');
    Route::get('admin/give-role-permissions', 'Admin\AdminController@getGiveRolePermissions');
    Route::post('admin/give-role-permissions', 'Admin\AdminController@postGiveRolePermissions');
    Route::resource('admin/roles', 'Admin\RolesController');
    Route::resource('admin/permissions', 'Admin\PermissionsController');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
    Route::resource('admin/city', 'CityController');
    Route::resource('admin/district', 'DistrictController');
    Route::resource('admin/town', 'TownController');
    Route::resource('admin/curriculum-vitae', 'CurriculumVitaeController');
    Route::resource('admin/companytype', 'CompanyTypeController');
    Route::resource('admin/job-type', 'JobTypeController');
    Route::resource('Admin/company-size', 'CompanySizeController');
    Route::resource('admin/job', 'JobController');
    Route::resource('admin/salary', 'SalaryController');
    Route::resource('master/category', 'CategoryController');
    Route::get('admin/apply', 'ApplyController@admin');
    Route::resource('admin/company', 'CompanyController');
    Route::resource('master/partner', 'PartnerController');
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'master'], function () {
    Route::post('city/active', 'CityController@active');
    Route::post('city/unactive', 'CityController@unactive');
    Route::get('city/admin', 'CityController@admin');

    Route::post('district/active', 'DistrictController@active');
    Route::post('district/unactive', 'DistrictController@unactive');
    Route::get('district/admin', 'DistrictController@admin');

    Route::post('curriculumvitae/vip', 'CurriculumVitaeController@vip');
    Route::post('curriculumvitae/unvip', 'CurriculumVitaeController@unvip');

    Route::post('job/vip', 'JobController@vip');
    Route::post('job/vip2', 'JobController@vip2');
    Route::post('job/unvip', 'JobController@unvip');

    Route::post('company/active', 'CompanyController@active');
    Route::post('company/unactive', 'CompanyController@unactive');
    Route::resource('admin/company', 'CompanyController');

    Route::post('apply/active', 'ApplyController@active');
    Route::post('apply/unactive', 'ApplyController@unactive');
    Route::get('admin/apply', 'ApplyController@admin');
    Route::resource('admin/companytype', 'CompanyTypeController');

    Route::post('post/active', 'PostController@active');
    Route::post('post/unactive', 'PostController@unactive');
    Route::resource('master/category', 'CategoryController');

    Route::post('jobtype/activespa', 'JobTypeController@activespa');
    Route::post('jobtype/unactivespa', 'JobTypeController@unactivespa');
    Route::post('jobtype/activeteacher', 'JobTypeController@activeteacher');
    Route::post('jobtype/unactiveteacher', 'JobTypeController@unactiveteacher');
    Route::resource('admin/job-type', 'JobTypeController');
    Route::resource('master/partner', 'PartnerController');
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'creator'], function () {
    Route::resource('post', 'PostController');
});

Route::get('/updateSlug', 'HomeController@updateSlug');
Route::get('/city/{id}', 'CityController@getAllSlug');
Route::get('/city/{id}/{slug}', 'CityController@getAllSlug');
Route::get('/district/{id}', 'DistrictController@getAllSlug');
Route::get('/district/{id}/{slug}', 'DistrictController@getAllSlug');
Route::get('/job/{id}', 'JobController@getSlug');
Route::get('/job/{id}/{slug}', 'JobController@getSlug');
Route::get('/company/{id}', 'CompanyController@getSlug');
Route::get('/company/{id}/{slug}', 'CompanyController@getSlug');