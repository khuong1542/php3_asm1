<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function post_login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            return redirect(route('dashboard'));
        } else {
            return back()->with('error', 'Email/Mật khẩu không chính xác!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
    public function index()
    {
        $model = User::paginate(10);
        return view('admin.users.index', compact('model'));
    }
    public function change_password()
    {
        return view('admin.administrators.change-password');
    }
    public function repassword(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->password, Auth::user()->password))) {
            return back()->with('message', 'Mật khẩu cũ không chính xác');
        }
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->get('repassword'));
        $data = [
            'id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'password' => $request->repassword,
        ];
        $user->save();
        Mail::send('mails.send-mail', $data, function ($message) use ($request) {
            $message->to(Auth::user()->email);
            $message->from('khuong1542@gmail.com', 'PHP3');
            $message->subject('Đổi mật khẩu thành công');
        });
        Auth::logout();
        return redirect(route('login'));
    }
    public function reset_password($id)
    {
        return view('reset-password');
    }
    public function updatepassword(ChangePasswordRequest $request, $id)
    {
        $user = User::find($id);
        if (!(Hash::check($request->password,  $user->password))) {
            return back()->with('message', 'Mật khẩu cũ không chính xác');
        }
        $user->password = Hash::make($request->get('repassword'));
        $data = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'password' => $request->repassword,
        ];
        $user->save();
        Mail::send('mails.send-mail', $data, function ($message) use ($request) {
            $message->to(Auth::user()->email);
            $message->from('khuong1542@gmail.com', 'PHP3');
            $message->subject('Đổi mật khẩu thành công');
        });
        Auth::logout();
        return redirect(route('login'));
    }
    public function infomation($id)
    {
        $model = User::find($id);
        return view('admin.users.infomation', compact('model'));
    }
}
