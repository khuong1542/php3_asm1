@extends('admin.layouts.master')
@section('title', 'Staff')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Danh sách nhân viên</h1>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">Tên</label>
                                <input type="text" name="keyword" class="form-control"
                                    value="{{$searchData['keyword']}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="{{$searchData['email']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('staffs.create')}}" class="btn btn-primary">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Email</th>
                            <th>Quyền</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if(count($model) > 0)
                            @foreach($model as $staff)
                            @if($staff->role_id == 2)
                            <tr>
                                <td>{{$staff->id}}</td>
                                <td>{{$staff->name}}</td>
                                <td><img src="{{$staff->avatar}}" width="70" alt="Ảnh đại diện"></td>
                                <td>{{$staff->email}}</td>
                                <td>
                                    @if(Auth::user()->role_id == 1)
                                    <form action="{{route('admin.update.role', ['id' => $staff->id])}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <select name="role_id" class="form-control col-6">
                                                    <option value="1" @if($staff->role_id == 1) selected @endif>Quản trị
                                                    </option>
                                                    <option value="2" @if($staff->role_id == 2) selected @endif>Nhân
                                                        viên
                                                    </option>
                                                    <option value="3" @if($staff->role_id == 3) selected @endif>Thành
                                                        viên
                                                    </option>
                                                </select>
                                                <button type="submit" class="btn btn-success">Lưu</button>
                                            </div>
                                        </div>
                                    </form>
                                    @else
                                    <span>Nhân viên</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('staffs.edit', ['staff' => $staff->id])}}"
                                        class="btn btn-warning">Sửa</a>
                                    <button type="submit" class="btn btn-danger" data-toggle="modal"
                                        data-target="#exampleModal{{$staff->id}}">Xóa</button>

                                    <div class="modal fade" id="exampleModal{{$staff->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Bạn chắc chắn
                                                        muốn xóa tài khoản nhân viên
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <th>Tên</th>
                                                            <th>Ảnh</th>
                                                            <th>Email</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{$staff->name}}</td>
                                                                <td><img src="{{$staff->avatar}}" width="70"
                                                                        alt="Ảnh đại diện"></td>
                                                                <td>{{$staff->email}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Đóng</button>
                                                    <form action="{{route('staffs.destroy', ['staff' => $staff->id])}}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10" class="text-center">Không tìm thấy nhân viên nào !</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    {{$model->onEachSide(1)->links()}}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection