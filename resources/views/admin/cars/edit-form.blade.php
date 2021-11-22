@extends('admin.layouts.master')
@section('title', 'Edit Car')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Sửa xe</h2>
            <div class="card">
                <div class="card-body">

                    <div class="add-form">
                        <form action="{{route('cars.update', ['car'=>$model->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-plate_number">
                            <div class="form-owner">
                                <label for="">Chủ nhân</label>
                                <input type="text" name="owner" class="form-control" value="{{$model->owner}}">
                            </div>
                            <div class="form-owner">
                                <label for="">Ảnh</label>
                                <input type="file" name="plate_image" class="form-control">
                                <img src="{{$model->plate_image}}" width="100" alt="Ảnh xe">
                            </div>
                                <label for="">Biển số xe</label>
                                <input type="text" name="plate_number" class="form-control"
                                    value="{{$model->plate_number}}">
                            </div>
                            <div class="form-travel_fee">
                                <label for="">Phí</label>
                                <input type="number" name="travel_fee" class="form-control"
                                    value="{{$model->travel_fee}}">
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