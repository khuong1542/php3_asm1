<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->has('keyword') ? $request->keyword : "";
        $email = isset($request->email) ? $request->email : '';
        $query = User::where('role_id', 2)->where('name','like',"%$keyword%");
        if(!empty($email)){
            $query->where('email','like',"%$email%");
        }
        $model = $query->paginate(10);
        $searchData = compact('keyword', 'email');
        if(session('success_message')){
            Alert::success('Thành công !', session('success_message'));
        }
        return view('admin.staffs.index', compact('model', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staffs.add-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        $model = new User();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/staffs', $filename);
            $model->avatar = 'uploads/staffs/'.$filename;
        }
        $model->role_id = 2;
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->save();
        return redirect(route('staffs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::find($id);
        return view('admin.staffs.edit-form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, $id)
    {
        $model = User::find($id);
        if ($request->hasFile('avatar')) {
            $unlink = 'uploads/staffs/' . $model->avatar;
            if (is_file($unlink)) {
                $link = str_replace('public/staffs/','',$unlink);
                unlink($link);
            }
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/staffs', $filename);
            $model->avatar = 'uploads/staffs/'.$filename;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('staffs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = User::find($id);
        $unlink = 'uploads/staffs/' . $model->avatar;
        if (is_file($unlink)) {
            unlink($unlink);
        }
        $model->delete();
        return redirect(route('staffs.index'))->withSuccessMessage('Xóa nhân viên thành công');
    }
}
