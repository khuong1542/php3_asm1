@extends('admin.layouts.master')
@section('title', 'Car')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
<h2>Danh sách xe</h2>
            <div class="card">
                <div class="card-header">
                    <a href="{{route('cars.create')}}" class="btn btn-primary">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Chủ xe</th>
                            <th>Ảnh</th>
                            <th>Biển số</th>
                            <th>Phí</th>
                            <th>Chuyến</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($model as $car)
                            <tr>
                                <td>{{$car->id}}</td>
                                <td>{{$car->owner}}</td>
                                <td><img src="{{$car->plate_image}}" width="70" alt="Ảnh xe"></td>
                                <td>{{$car->plate_number}}</td>
                                <td>{{$car->travel_fee}}</td>
                                <td>{{count($car->passenger)}}</td>
                                <td>
                                    <form action="{{route('cars.destroy', ['car' => $car->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('cars.edit', ['car' => $car->id])}}"
                                            class="btn btn-warning">Sửa</a>
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
@endsection