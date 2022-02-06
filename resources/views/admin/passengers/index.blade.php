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
                <h1>Danh sách hành khách</h1>
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
                        <form action="" method="get">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">Tên khách</label>
                                    <input type="text" name="keyword" class="form-control"
                                        value="{{$searchData['keyword']}}">
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Xe</label>
                                    <select name="car_id" class="form-control selectpicker" data-live-search="true">
                                        <option aria-disabled="" style="font-size: 14pt; font-weight: 700;">
                                            <h2>Tên xe-------------------------
                                                Biển số-------------------------
                                                Phí</h2>
                                        </option>
                                        @foreach($cars as $car)
                                        <option value="{{$car->id}}" @if($searchData['car_id']==$car->id) selected
                                            @endif>
                                            {{$car->owner}}-------------------------
                                            ( {{$car->plate_number}} )-------------------------
                                            ( {{$car->travel_fee}} )
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="">Giá</label>
                                <div id="slider-range"></div>
                                <input type="text" name="travel_fee" id="amount" class="form-control" readonly
                                    style="border:none; font-size: 16pt; background:none">
                                <input type="hidden" name="start_travel_fee" id="start_travel_fee">
                                <input type="hidden" name="end_travel_fee" id="end_travel_fee">
                            </div> -->
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
                                <th>Tên xe</th>
                                <th>Biển số</th>
                                <th>Phí</th>
                                <th>Thời gian</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @if(count($model) > 0)
                                @foreach($model as $passenger)
                                <tr>
                                    <td>{{$passenger->id}}</td>
                                    <td>{{$passenger->name}}</td>
                                    <td class="text-center"><img src="{{$passenger->avatar}}" width="70"
                                            alt="Ảnh đại diện"></td>
                                    <td>{{$passenger->cars->owner}}</td>
                                    <td>{{$passenger->cars->plate_number}}</td>
                                    <td>{{$passenger->cars->travel_fee}}</td>
                                    <td>
                                        @if($passenger->travel_time != null)
                                        {{date('H:m d/m/Y', strtotime($passenger->travel_time))}}
                                        @else
                                        Không tồn tại
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('passengers.edit', ['passenger' => $passenger->id])}}"
                                            class="btn btn-warning">Sửa</a>
                                        <button type="submit" class="btn btn-danger" data-toggle="modal"
                                            data-target="#exampleModal{{$passenger->id}}">Xóa</button>

                                        <div class="modal fade" id="exampleModal{{$passenger->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Bạn chắc
                                                            chắn muốn xóa hành khách
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                                <th>Tên khách</th>
                                                                <th>Tên xe</th>
                                                                <th>Biển số</th>
                                                                <th>Thời gian</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{$passenger->name}}</td>
                                                                    <td>{{$passenger->cars->owner}}</td>
                                                                    <td>{{$passenger->cars->plate_number}}</td>
                                                                    <td>
                                                                        @if($passenger->travel_time != null)
                                                                        {{date('H:m d/m/Y', strtotime($passenger->travel_time))}}
                                                                        @else
                                                                        Không tồn tại
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng</button>
                                                        <form
                                                            action="{{route('passengers.destroy', ['passenger' => $passenger->id])}}"
                                                            method="post">
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
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10" class="text-center">Không tìm thấy hành khách nào !</td>
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
</section>
@endsection