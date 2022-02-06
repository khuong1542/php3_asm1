@extends('admin.layouts.master')
@section('title', 'Edit Car')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sửa xe</h1>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="add-form">
                        <form action="{{route('cars.update', ['car'=>$model->id])}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-plate_number">
                                <div class="form-owner">
                                    <label for="">Tên xe</label>
                                    <input type="text" name="owner" class="form-control"
                                        value="{{old('name', $model->owner)}}">
                                    @error('owner')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-owner">
                                    <label for="">Ảnh</label>
                                    <input type="file" name="plate_image" class="form-control">
                                    @error('plate_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <img src="{{$model->plate_image}}" width="100" alt="Ảnh xe">
                                </div>
                                <label for="">Biển số xe</label>
                                <input type="text" name="plate_number" class="form-control"
                                    value="{{old('plate_number', $model->plate_number)}}">
                                @error('plate_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-travel_fee">
                                <label for="">Phí</label>
                                <input type="number" name="travel_fee" class="form-control"
                                    value="{{old('travel_fee', $model->travel_fee)}}">
                                @error('travel_fee')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-button">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <a href="{{route('cars.index')}}" class="btn btn-danger">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection