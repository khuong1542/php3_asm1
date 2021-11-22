<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Car::paginate(10);
        return view('admin.cars.index', compact('model'));
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
    public function store(Request $request)
    {
        $model = new Car();
        $model->fill($request->all());
        if($request->hasFile('plate_image')){
            $deleteImg = str_replace('public/', 'storage/', $model->plate_image);
            Storage::delete($deleteImg);
            $image = $request->file('plate_image')->store('public/cars');
            $plate_image = str_replace('public/', 'storage/', $image);
            $model->plate_image = $plate_image;
        }
        $model->save();
        return redirect(route('cars.index'));
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
    public function update(Request $request, $id)
    {
        $model = Car::find($id);
        $model->fill($request->all());
        
        if($request->hasFile('plate_image')){
            $deleteImg = str_replace('public/', 'storage/', $model->plate_image);
            Storage::delete($deleteImg);
            $image = $request->file('plate_image')->store('public/cars');
            $plate_image = str_replace('public/', 'storage/', $image);
            $model->plate_image = $plate_image;
        }
        $model->save();
        return redirect(route('cars.index'));
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
        return redirect(route('cars.index'));
    }
}
