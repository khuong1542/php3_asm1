@extends('admin.layouts.master')
@section('title', 'Passenger')
@section('css')
<style>
    /* .card-header{
        position: sticky;top: 0;left: 0;right: 0; z-index: 1;
    } */
</style>
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Danh sách khách</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('passengers.create')}}" class="btn btn-primary">
                            <h3 class="card-title">Thêm mới</h3>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Tên khách</th>
                                <th class="text-center">Ảnh</th>
                                <th>Chủ xe</th>
                                <th>Biển số</th>
                                <th>Phí</th>
                                <th>Thời gian</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($model as $passengers)
                                <tr>
                                    <td>{{$passengers->id}}</td>
                                    <td>{{$passengers->name}}</td>
                                    <td  class="text-center"><img src="{{$passengers->avatar}}" width="70" alt="Ảnh đại diện"></td>
                                    <td>{{$passengers->cars->owner}}</td>
                                    <td>{{$passengers->cars->plate_number}}</td>
                                    <td>{{$passengers->cars->travel_fee}}</td>
                                    <td>
                                        @if($passengers->travel_time != null)
                                        {{date('H:m d/m/Y', strtotime($passengers->travel_time))}}
                                        @else
                                        Không tồn tại
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{route('passengers.destroy', ['passenger' => $passengers->id])}}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <!-- <a href="{{route('passengers.edit', ['passenger' => $passengers->id])}}"
                                                class="btn btn-warning">Sửa</a> -->
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return Delete()">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
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
</section>
@endsection