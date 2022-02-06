<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassengerRequest;
use App\Models\Car;
use App\Models\Passenger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Generator\StringManipulation\Pass\Pass;
use RealRashid\SweetAlert\Facades\Alert;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $model = Passenger::paginate(10);
        $cars = Car::all();
        $keyword = $request->has('keyword') ? $request->keyword : "";
        $car_id = isset($request->car_id) ? $request->car_id : '';
        $query = Passenger::where('name', 'like', "%$keyword%");
        if(!empty($car_id)){
            $query->where('car_id', $car_id);
        }
        $model = $query->paginate(10);
        $model->load('cars');
        if(session('success_message')){
            Alert::success('Thành công !', session('success_message'));
        }
        $searchData = compact('keyword', 'car_id');

        // dd(date('Y', strtotime()))
        return view('admin.passengers.index', compact('model', 'cars', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = Car::all();
        return view('admin.passengers.add-form', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PassengerRequest $request)
    {
        $model = new Passenger();
        $model->fill($request->all());
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/passengers', $filename);
            $model->avatar = 'uploads/passengers/'.$filename;
        }
        if (strtotime($request->travel_time) > strtotime(Carbon::now())) {
            $model->travel_time = $request->travel_time;
        }
        $model->save();
        return redirect(route('passengers.index'))->withSuccessMessage('Thêm thành công');
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
        $model = Passenger::find($id);
        $cars = Car::all();
        return view('admin.passengers.edit-form', compact('model', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PassengerRequest $request, $id)
    {
        $model = Passenger::find($id);
        $model->fill($request->all());
        if(!$model){
            return back();
        }
        if($request->hasFile('avatar')){
            $unlink = $model->avatar;
            if(is_file($unlink)){
                $link = str_replace('public/passengers/','',$unlink);
                unlink($link);
            }
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/passengers', $filename);
            $model->avatar = 'uploads/passengers/'.$filename;
        }
        $model->save();
        return redirect(route('passengers.index'))->withSuccessMessage('Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Passenger::find($id)->delete();
        return redirect(route('passengers.index'))->withSuccessMessage('Xóa thành công');
    }
}
