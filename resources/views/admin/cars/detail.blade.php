@extends('admin.layouts.master')
@section('title', 'Show Car')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Các chuyến đã được đặt</h1>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID Chuyến</th>
                            <th>Tên Khách</th>
                            <th>Thời gian</th>
                        </thead>
                        <tbody>
                            @foreach($model->passengers as $pass)
                            <tr>
                                <td>{{$pass->passenger->id}}</td>
                                <td>{{$pass->passenger->name}}</td>
                                <td>{{$pass->passenger->travel_time}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection