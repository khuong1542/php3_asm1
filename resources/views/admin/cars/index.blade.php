@extends('admin.layouts.master')
@section('title', 'Car')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Danh sách xe</h1>
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
                                <label for="">Tên xe</label>
                                <input type="text" name="keyword" class="form-control"
                                    value="{{$searchData['keyword']}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="">Biển số</label>
                                <input type="text" name="plate_number" class="form-control"
                                    value="{{$searchData['plate_number']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Giá</label>
                            <div id="slider-range"></div>
                            <input type="text" name="travel_fee" id="amount" class="form-control" readonly
                                style="border:none; font-size: 16pt; background:none">
                            <input type="hidden" name="start_travel_fee" id="start_travel_fee"
                                value="{{$searchData['start_travel_fee']}}">
                            <input type="hidden" name="end_travel_fee" id="end_travel_fee"
                                value="{{$searchData['end_travel_fee']}}">
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
                    <a href="{{route('cars.create')}}" class="btn btn-primary">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Tên xe</th>
                            <th>Ảnh</th>
                            <th>Biển số</th>
                            <th>Phí</th>
                            <th>Chuyến</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if(count($model) > 0)
                            @foreach($model as $car)
                            <tr>
                                <td>{{$car->id}}</td>
                                <td>{{$car->owner}}</td>
                                <td><img src="{{$car->plate_image}}" width="70" alt="Ảnh xe"></td>
                                <td>{{$car->plate_number}}</td>
                                <td>{{$car->travel_fee}}</td>
                                <td>{{count($car->passengers)}}</td>
                                <td>
                                    <a href="{{route('cars.edit', ['car' => $car->id])}}"
                                        class="btn btn-warning">Sửa</a>
                                    <button type="submit" class="btn btn-danger" data-toggle="modal"
                                        data-target="#exampleModal{{$car->id}}">Xóa</button>

                                    <div class="modal fade" id="exampleModal{{$car->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Bạn chắc chắn
                                                        muốn xóa xe
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <th>Tên xe</th>
                                                            <th>Ảnh</th>
                                                            <th>Biển số</th>
                                                            <th>Phí</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{$car->owner}}</td>
                                                                <td><img src="{{$car->plate_image}}" width="70"
                                                                        alt="Ảnh xe"></td>
                                                                <td>{{$car->plate_number}}</td>
                                                                <td>{{$car->travel_fee}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Đóng</button>
                                                    <form action="{{route('cars.destroy', ['car' => $car->id])}}"
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
                                <td colspan="10" class="text-center">Không tìm thấy xe nào !</td>
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
@section('script')
<script>
$(document).ready(function() {
    $("#slider-range").slider({
        orientation: "horizontal",
        min: {{ $min_travel_fee }} - 500,
        max: {{ $max_travel_fee }} + 1000,
        range: true,
        values: [{{ $min_travel_fee }}, {{ $max_travel_fee }}],
        slide: function(event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            $("#start_travel_fee").val(ui.values[0]);
            $("#end_travel_fee").val(ui.values[1]);
        }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
        " - $" + $("#slider-range").slider("values", 1));
});
</script>
@endsection