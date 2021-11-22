@extends('admin.layouts.master')
@section('title', 'Add Passenger')
@section('content')
<section class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Thêm mới khách</h2>
                </div>
                <div class="card-body">
                    <div class="add-form">
                        <form action="{{route('passengers.store')}}" method="post">
                            @csrf
                            <div class="form-name">
                                <label for="">Tên</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-name">
                                <label for="">Ảnh</label>
                                <input type="file" name="avatar" class="form-control">
                            </div>
                            <div class="form-owner">
                                <label for="">Xe</label>
                                <select name="car_id" class="form-control selectpicker" data-live-search="true">
                                    <option aria-disabled="" style="font-size: 14pt; font-weight: 700;">
                                        <h2>Tài xế-------------------------
                                            Biển số-------------------------
                                            Phí</h2>
                                    </option>
                                    @foreach($model as $car)
                                    <option value="{{$car->id}}">
                                        {{$car->owner}}-------------------------
                                        ( {{$car->plate_number}} )-------------------------
                                        ( {{$car->travel_fee}} )
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-travel_time col-md-6">
                                    <label for="">Thời gian</label>
                                    <input type="datetime-local" name="travel_time" class="form-control ">
                                </div>
                            </div>
                            <div class="form-button">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <button type="reset" class="btn btn-warning">Đặt lại</button>
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