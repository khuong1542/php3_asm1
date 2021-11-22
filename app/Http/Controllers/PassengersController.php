<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Passenger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PassengersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Passenger::paginate(10);
        $model->load('cars');
        return view('admin.passengers.index', compact('model'));
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
    public function store(Request $request)
    {
        $model = new Passenger();
        $model->fill($request->all());
        if($request->hasFile('avatar')){
            $deleteImg = str_replace('public/', 'storage/', $model->avatar);
            Storage::delete($deleteImg);
            $image = $request->file('avatar')->store('public/passengers');
            $avatar = str_replace('public/', 'storage/', $image);
            $model->avatar = $avatar;
        }
        if ($request->travel_time > Carbon::now()) {
            $model->travel_time = $request->travel_time;
        } else {
            $model->travel_time = null;
        }

        $model->save();
        return redirect(route('passengers.index'));
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
    public function update(Request $request, $id)
    {
        $model = Passenger::find($id);
        $model->fill($request->all());
        if(!$model){
            return back();
        }
        if($request->hasFile('avatar')){
            $deleteImg = str_replace('public/', 'storage/', $model->avatar);
            Storage::delete($deleteImg);
            $image = $request->file('avatar')->store('public/passengers');
            $avatar = str_replace('public/', 'storage/', $image);
            $model->avatar = $avatar;
        }
        $model->save();
        return redirect(route('passengers.index'));
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
        return redirect(route('passengers.index'));
    }
}
