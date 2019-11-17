<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\MessageBag;

class ProfileController extends Controller
{
    public function __construct () {
        $this->middleware('auth');
    }

    public function getProfile () {
        $currPage = 'users';
        $title = 'Hồ sơ';
        $user = User::where('id', Auth::user()->id)->first();
        // dd($user);
        return view('admin/profile', compact('user','currPage', 'title'));
    }

    public function postProfile (Request $request) {
        $rules = [
            // 'username' =>'required|min:3',
    		'email' => 'required|email',
    		'phone' =>'required|regex:/(0)[0-9]{9}/', //min:10|max:10|
    		'fullname' => 'required|min:4|max:33'
    	];
    	$messages = [
    		// 'username.required' => 'Username là trường bắt buộc',
    		// 'username.min' => 'Username phải chứa ít nhất 3 kí tự',
    		'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email chưa đúng định dạng',
            'phone.required' => 'Số điện thoại là trường bắt buộc',
            'phone.email' => 'Số điện thoại chưa đúng định dạng',
            'fullname.required' => 'Họ và tên là trường bắt buộc',
            'fullname.min' => 'Họ và tên chứa ít nhất 4 kí tự',
            'fullname.max' => 'Họ và tên chỉ chứa tối đa 33 kí tự'
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {
            $user = User::where('id', Auth::user()->id)->first();

            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->fullname = $request->fullname;

            $user->save();
            return redirect(route('profile'));
        }
    }

    public function getEditPassword () {
        $currPage = 'users';
        $title = 'Đổi mật khẩu';
        return view('admin.edit-password', compact('currPage', 'title'));
    }

    public function postEditPassword (Request $request) {
        $rules = [
    		'current-password' => 'required|min:5',
    		'new-password' =>'required|min:5',
    		'retype-new-password' => 'required|min:5'
    	];
    	$messages = [
    		'current-password.required' => 'Mật khẩu là trường bắt buộc',
            'current-password.min' => 'Mật khẩu chứa ít nhất 5 kí tự',
            'new-password.required' => 'Mật khẩu mới là trường bắt buộc',
            'new-password.min' => 'Mật khẩu chứa ít nhất 5 kí tự',
            'retype-new-password.required' => 'Mời bạn nhập lại mật khẩu',
            'retype-new-password.min' => 'Mật khẩu chứa ít nhất 5 kí tự'
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {

            $password = $request->input('current-password');
            if( Auth::attempt(['password' =>$password, 'username' => Auth::user()->username])){
                if($request->input('new-password') == $request->input('retype-new-password')){
                    $user = User::where('id', Auth::user()->id)->first();
                    $user->password = bcrypt($request->input('new-password'));
                    $user->save();
                    return redirect(route('profile'));
                } else {
                    $errors = new MessageBag(['errornotmatch' => 'Mật khẩu không trùng khớp']);
                    // dd($errors);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            } else {
                //dang nhap loi
                $errors = new MessageBag(['errorpassword' => 'Mật khẩu không đúng']);
                // dd($errors);
                return redirect()->back()->withInput()->withErrors($errors);
            }

        }
    }
}
