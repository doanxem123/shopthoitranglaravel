@extends('layout')
@section('content')
<div>
	<br>
	<span>
		Bạn cần đăng nhập để vào chức năng này <a href="{{URL::to('/login')}}">Đăng nhập</a> hoặc <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
	</span>
	<div class="clearfix"></div>
	<br>
</div>
@endsection