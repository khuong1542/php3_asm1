@extends('admin.layouts.master')
@section('title', 'Add Car')
@section('content')
<h2>Thêm mới xe</h2>
<div class="add-form">
    <form action="{{route('cars.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-plate_number">
            <label for="">Biển số xe</label>
            <input type="text" name="plate_number" class="form-control">
        </div>
        <div class="form-owner">
            <label for="">Chủ nhân</label>
            <input type="text" name="owner" class="form-control">
        </div>
        <div class="form-travel_fee">
            <label for="">Phí</label>
            <input type="number" name="travel_fee" class="form-control">
        </div>
        <div class="form-button">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <button type="reset" class="btn btn-warning">Đặt lại</button>
            <a href="{{route('cars.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </form>
</div>
@endsection