<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
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
        $query = User::where('role_id', 3)->where('name','like',"%$keyword%");
        if(!empty($email)){
            $query->where('email','like',"%$email%");
        }
        $model = $query->paginate(10);
        $searchData = compact('keyword', 'email');
        if(session('success_message')){
            Alert::success('Thành công !', session('success_message'));
        }
        return view('admin.members.index', compact('model', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.add-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $model = new User();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/members', $filename);
            $model->avatar = 'uploads/members/'.$filename;
        }
        $model->role_id = 2;
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->save();
        return redirect(route('members.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        return view('admin.members.edit-form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, $id)
    {
        $model = User::find($id);
        if ($request->hasFile('avatar')) {
            $unlink = $model->avatar;
            if (is_file($unlink)) {
                $link = str_replace('public/members/','',$unlink);
                unlink($link);
            }
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/members', $filename);
            $model->avatar = 'uploads/members/'.$filename;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('members.index'));
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
        $unlink = 'uploads/members/' . $model->avatar;
        if (is_file($unlink)) {
            unlink($unlink);
        }
        $model->delete();
        return redirect(route('members.index'))->withSuccessMessage('Xóa thành viên thành công');
    }
}
