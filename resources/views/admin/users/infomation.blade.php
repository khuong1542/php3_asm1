@extends('admin.layouts.master')
@section('title', 'Infomation')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Hồ sơ cá nhân</h1>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{Auth::user()->avatar}}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                        @if(Auth::user()->role_id == 1)
                        <p class="text-muted text-center">Quản trị</p>
                        @elseif(Auth::user()->role_id == 2)
                        <p class="text-muted text-center">Nhân viên</p>
                        @else
                        <p class="text-muted text-center">Thành viên</p>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <h4>Thông tin cá nhân</h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <ul class="list-group list-group-unbordered mb-3 form-group">
                                        <div class="">
                                            <b>Email</b> <input type="text" class="form-control" readonly
                                                value="{{Auth::user()->email}}">
                                        </div>
                                        <div class="">
                                            <b>Ngày lập</b> <input type="text" readonly class="form-control"
                                                value="{{Auth::user()->created_at}}">
                                        </div>
                                    </ul>
                                </div>
                                <!-- /.post -->
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection