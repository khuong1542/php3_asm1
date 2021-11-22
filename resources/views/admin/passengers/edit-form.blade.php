@extends('admin.layouts.master')
@section('title', 'Add Passenger')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Sửa khách</h2>
                    </div>
                    <div class="card-body">
                        <div class="add-form">
                            <form action="{{route('passengers.update', ['passenger' => $model->id])}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-name">
                                    <label for="">Tên</label>
                                    <input type="text" name="name" class="form-control" value="{{$model->name}}">
                                </div>
                                <div class="form-name">
                                    <label for="">Ảnh</label>
                                    <input type="file" name="avatar" class="form-control">
                                    <img src="{{$model->avatar}}" width="100" alt="Ảnh khách">
                                </div>
                                <div class="form-owner">
                                    <label for="">Xe</label>
                                    <select name="car_id" class="form-control">
                                        <option aria-disabled="" style="font-size: 14pt; font-weight: 700;">
                                            <h2>Tài xế-------------------------
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
                                        value="{{date('Y-m-d\TH:i', strtotime($model->travel_time))}}">
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