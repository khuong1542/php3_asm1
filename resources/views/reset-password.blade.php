@include('admin.layouts.css')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Đổi mật khẩu</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="col-6 offset-3">
                            @csrf
                            <div class="form-group">
                                <label for="">Mật khẩu cũ</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                @if(Session::has('message'))
                                <p class="text-danger">
                                    {{ Session::get('message') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu mới</label>
                                <input type="password" name="repassword" class="form-control">
                                @error('repassword')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                @if(Session::has('error'))
                                <p class="text-danger">
                                    {{ Session::get('error') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Nhập lại mật khẩu mới</label>
                                <input type="password" name="confpassword" class="form-control">
                                @error('confpassword')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>