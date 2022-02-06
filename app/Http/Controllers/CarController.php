<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\Passenger;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $model = Car::paginate(10);
        $pageSize = 10;
        $min_travel_fee = Car::min('travel_fee');
        $max_travel_fee = Car::max('travel_fee');
        $keyword = $request->has('keyword') ? $request->keyword : "";
        $plate_number = isset($request->plate_number) ? $request->plate_number : '';
        $start_travel_fee = isset($request->start_travel_fee) ? $request->start_travel_fee : '';
        $end_travel_fee = isset($request->end_travel_fee) ? $request->end_travel_fee : '';
        $query = Car::where('owner','like',"%$keyword%");
        if(!empty($plate_number)){
            $query->where('plate_number','like',"%$plate_number%");
        }
        if(!empty($start_travel_fee) && $end_travel_fee){
            $query->whereBetween('travel_fee', [$start_travel_fee, $end_travel_fee]);
        }
        $model = $query->paginate($pageSize);
        if(session('success_message')){
            Alert::success('Thành công !', session('success_message'));
        }
        $searchData = compact('keyword', 'plate_number');
        $searchData['start_travel_fee'] = $start_travel_fee;
        $searchData['end_travel_fee'] = $end_travel_fee;
        return view('admin.cars.index', compact('model','min_travel_fee','max_travel_fee', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cars.add-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        $model = new Car();
        $model->fill($request->all());
        if($request->hasFile('plate_image')){
            $file = $request->file('plate_image');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/cars', $filename);
            $model->plate_image = 'uploads/cars/'.$filename;
        }
        $model->save();
        return redirect(route('cars.index'))->withSuccessMessage('Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Car::find($id);
        $model->load('passengers');
        return view('admin.cars.detail', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Car::find($id);
        return view('admin.cars.edit-form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, $id)
    {
        $model = Car::find($id);
        $model->fill($request->all());
        
        if($request->hasFile('plate_image')){
            $unlink = $model->plate_image;
            if(is_file($unlink)){
                $link = str_replace('public/cars/','',$unlink);
                unlink($link);
            }
            $file = $request->file('plate_image');
            $name = $file->getClientOriginalName();
            $filename = uniqid() . '-' . $name;
            $file->move('uploads/cars', $filename);
            $model->plate_image = 'uploads/cars/'.$filename;
        }
        $model->save();
        return redirect(route('cars.index'))->withSuccessMessage('Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Car::find($id)->delete();
        $model = Car::find($id);
        Passenger::where('car_id', $model->id)->delete();
        $model->delete();
        return redirect(route('cars.index'))->withSuccessMessage('Xóa xe thành công');
    }
}
