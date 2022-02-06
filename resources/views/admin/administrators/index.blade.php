@extends('admin.layouts.master')
@section('title', 'AdminIstrator')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Danh sách quản trị</h1>
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
                    <a href="{{route('admin.create')}}" class="btn btn-primary">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Email</th>
                            <th>Quyền</th>
                            @if(Auth::user()->role_id == 1)
                            <th></th>
                            @endif
                        </thead>
                        <tbody>
                            @if(count($model) > 0)
                            @foreach($model as $admin)
                            @if($admin->role_id == 1)
                            <tr>
                                <td>{{$admin->id}}</td>
                                <td>{{$admin->name}}</td>
                                <td><img src="{{$admin->avatar}}" width="70" alt="Ảnh đại diện"></td>
                                <td>{{$admin->email}}</td>
                                @if(Auth::user()->id != $admin->id && Auth::user()->role_id == 1)
                                <td>
                                    <form action="{{route('admin.update.role', ['id' => $admin->id])}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <select name="role_id" class="form-control col-6">
                                                    <option value="1" @if($admin->role_id == 1) selected @endif>Quản trị
                                                    </option>
                                                    <option value="2" @if($admin->role_id == 2) selected @endif>Nhân
                                                        viên
                                                    </option>
                                                    <option value="3" @if($admin->role_id == 3) selected @endif>Thành
                                                        viên
                                                    </option>
                                                </select>
                                                <button type="submit" class="btn btn-success">Lưu</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                @else
                                <td>
                                    <span>Quản trị</span>
                                </td>
                                @endif
                                <td>

                                    @if(Auth::user()->id == $admin->id)
                                    <a href="{{route('admin.edit', ['id' => $admin->id])}}"
                                        class="btn btn-warning">Sửa</a>
                                    @endif
                                    @if(Auth::user()->id != $admin->id)
                                    <button type="submit" class="btn btn-danger" data-toggle="modal"
                                        data-target="#exampleModal{{$admin->id}}">Xóa</button>

                                    @endif

                                    <div class="modal fade" id="exampleModal{{$admin->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Bạn chắc chắn
                                                        muốn xóa tài khoản quản trị viên
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
                                                                <td>{{$admin->name}}</td>
                                                                <td><img src="{{$admin->avatar}}" width="70"
                                                                        alt="Ảnh đại diện"></td>
                                                                <td>{{$admin->email}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Đóng</button>
                                                    <form action="{{route('admin.destroy', ['id' => $admin->id])}}"
                                                        method="post">
                                                        @csrf
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
                                <td colspan="10" class="text-center">Không tìm thấy quản trị viên nào !</td>
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