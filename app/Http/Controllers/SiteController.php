<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;

class SiteController extends Controller
{
    public function loginApi(Request $request){
        $credentials = array('email' => $request->input('email'), 'password' => $request->input('password'));
        if(\Auth::attempt($credentials, false)){
            return \Response::json(array('code' => '200', 'message' => 'success'));
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
    }

    public function registerApi(Request $request){
        $user = User::Where('email', $request->input('email'))->first();
        if(!$user){
            $user_register = User::create([
                'name' => $request->input('username'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
            ]);

            if($user_register){
                if($request->input('role') == 2){
                    $user_register->assignRole('poster');
                    $dataUser = array('email'=>$request->input('email'), 'name'=>$request->input('username'));
                    Mail::send('emails.registerNTD', [], function($message) use ($dataUser) {
                        $message->from('support@gmon.com.vn', 'gmon.vn');
                        $message->to($dataUser['email'])->subject('Gmon.vn thông báo đăng ký thành công!');
                    });
                }else{
                    $user_register->assignRole('user');
                    $dataUser = array('email'=>$request->input('email'), 'name'=>$request->input('username'));
                    Mail::send('emails.registerUV', [], function($message) use ($dataUser) {
                        $message->from('support@gmon.com.vn', 'gmon.vn');
                        $message->to($dataUser['email'])->subject('Gmon.vn thông báo đăng ký thành công!');
                    });
                }


                $credentials = array('email' => $request->input('email'), 'password' => $request->input('password'));
                if(\Auth::attempt($credentials, false)){
                    return \Response::json(array('code' => '200', 'message' => 'success'));
                }
            }

            return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
        }else{
            return \Response::json(array('code' => '201', 'message' => 'Email đã tồn tại'));
        }
    }
}