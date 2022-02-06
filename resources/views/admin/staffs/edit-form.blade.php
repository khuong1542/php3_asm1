@extends('admin.layouts.master')
@section('title', 'Edit Staff')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sửa nhân viên</h1>
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
                            <form action="{{route('staffs.update', ['staff' => $model->id])}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Tên</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{old('name', $model->name)}}">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Ảnh</label>
                                    <input type="file" name="avatar" class="form-control">
                                    @error('avatar')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <img src="{{$model->avatar}}" width="100" alt="Ảnh đại diện">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{old('email', $model->email)}}">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-button">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                    <a href="{{route('staffs.index')}}" class="btn btn-danger">Hủy</a>
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