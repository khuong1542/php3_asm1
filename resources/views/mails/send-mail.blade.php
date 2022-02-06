<h3>Chào {{$name}}</h3>
<div class="form">
    <p>Cảm ơn bạn đã tin dùng dịch vụ.</p>
    <p>Mật khẩu của bạn đã được cập nhật thành công!</p>
    <p>Nếu không phải bạn hãy ấn đổi mật khẩu ngay: </p> <a href="{{route('reset-password', ['id' => $id])}}">Đổi mật khẩu</a>
</div>