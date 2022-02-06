@extends('admin.layouts.master')
@section('title', 'Edit Passenger')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sửa hành khách</h1>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="add-form">
                            <form action="{{route('passengers.update', ['passenger' => $model->id])}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-name">
                                    <label for="">Tên</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{old('name', $model->name)}}">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-name">
                                    <label for="">Ảnh</label>
                                    <input type="file" name="avatar" class="form-control">
                                    <img src="{{$model->avatar}}" width="100" alt="Ảnh khách">
                                    @error('avatar')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-owner">
                                    <label for="">Xe</label>
                                    <select name="car_id" class="form-control">
                                        <option aria-disabled="" style="font-size: 14pt; font-weight: 700;">
                                            <h2>Tên xe
                                                -------------------------
                                                Biển số-------------------------
                                                Phí</h2>
                                        </option>
                                        @foreach($cars as $car)
                                        <option value="{{$car->id}}" @if($car->id == $model->car_id) selected @endif>
                                            {{$car->owner}}-------------------------
                                            ( {{$car->plate_number}} )-------------------------
                                            ( {{$car->travel_fee}} )
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-travel_time">
                                    <label for="">Thời gian bắt đầu</label>
                                    <input type="datetime-local" name="travel_time" class="form-control"
                                        value="{{old('travel_time', date('Y-m-d\TH:i', strtotime($model->travel_time)))}}">
                                    @error('travel_time')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-button">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                    <a href="{{route('passengers.index')}}" class="btn btn-danger">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection