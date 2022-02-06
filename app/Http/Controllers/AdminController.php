<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\ModelHasRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function list_admin(Request $request){
        $keyword = $request->has('keyword') ? $request->keyword : "";
        $email = isset($request->email) ? $request->email : '';
        $query = User::where('role_id', 1)->where('name','like',"%$keyword%");
        if(!empty($email)){
            $query->where('email','like',"%$email%");
        }
        $model = $query->paginate(10);
        $searchData = compact('keyword', 'email');
        if(session('success_message')){
            Alert::success('Thành công !', session('success_message'));
        }
        return view('admin.administrators.index', compact('model', 'searchData'));
    }
    public function create(){
        return view('admin.administrators.add-form');        
    }
    public function store(AdminRequest $request){
        $model = new User();
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/admin', $filename);
            $model->avatar = 'uploads/admin/'.$filename;
        }
        $model->role_id = 1;
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->save();
        // ModelHasRole::where('model_id', $model->id)->delete();
        $item = [
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => $model->id
        ];
        DB::table('model_has_roles')->insert($item);
        return redirect(route('admin.list'))->withSuccessMessage('Thêm quản trị viên thành công');
    }
    public function edit($id){
        $model = User::find($id);
        return view('admin.administrators.edit-form', compact('model'));
    }
    public function update(AdminRequest $request, $id){
        $model = User::find($id);
        if($request->hasFile('avatar')){
            $unlink = $model->avatar;
            if(is_file($unlink)){
                $link = str_replace('public/admin/','',$unlink);
                unlink($link);
            }
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/admin', $filename);
            $model->avatar = 'uploads/admin/'.$filename;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('admin.list'))->withSuccessMessage('Sửa thông tin thành công');
    }
    public function destroy($id){
        $model = User::find($id);
        if($model->id == Auth::id() && Auth::user()->role_id == 1){
            Alert::warning('Cảnh báo!', 'Bạn không được xóa tài khoản này!');
            return back();
        }
        $model->delete();
        return redirect(route('admin.list'))->withSuccessMessage('Xóa quản trị viên thành công');
    }
    // public function down_role_id($id){
    //     $model = User::find($id);
    //     $model->role_id = 2;
    //     return redirect(route('admin.list'));
    // }
    public function update_role(Request $request ,$id){
        $model = User::find($id);
        $model->role_id = $request->role_id;
        $model->save();
        ModelHasRole::where('model_id', $model->id)->delete();
        $item = [
            'role_id' => $request->role_id,
            'model_type' => 'App\Models\User',
            'model_id' => $model->id
        ];
        DB::table('model_has_roles')->insert($item);
        return back();
    }
}