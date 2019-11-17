<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function getLogin(){
        return view('admin/login');
    }

    public function postLogin(Request $request){

        // $users = User::where('id', $request->username)->first();

        $rules = [
    		'username' =>'required|min:3',
    		'password' => 'required|min:3'
    	];
    	$messages = [
    		'username.required' => 'Username là trường bắt buộc',
    		'username.min' => 'Username phải chứa ít nhất 3 kí tự',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải chứa ít nhất 3 ký tự',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {
            $email = $request->input('username');
            // dd($email);
    		$username = $request->input('username');
    		$password = $request->input('password');

            if( Auth::attempt(['username' =>$username, 'password' =>$password]) ||
                Auth::attempt(['email' =>$email, 'password' =>$password])) {
                //dang nhap thang cong
    			return redirect()->intended('/admin');
    		} else {
                //dang nhap loi
                $errors = new MessageBag(['errorlogin' => 'Username hoặc mật khẩu không đúng']);
                // dd($errors);
                return redirect()->back()->withInput()->withErrors($errors);
    		}
    	}
    }
}
