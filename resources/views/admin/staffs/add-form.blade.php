@extends('admin.layouts.master')
@section('title', 'Create Staff')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm mới nhân viên</h1>
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
                            <form action="{{route('staffs.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="">Tên</label>
                                        <input type="text" name="name" class="form-control"  value="{{old('name')}}">
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Ảnh</label>
                                        <input type="file" name="avatar" class="form-control">
                                        @error('avatar')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{old('email')}}">
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Mật khẩu</label>
                                        <input type="password" name="password" class="form-control">
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
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