@extends('layout')
@section('content')
<div>
	<br>
	<span>
		Bạn đang cố vào trang đặt hàng mà chưa có sản phẩm nào <a href="{{URL::to('/trang-chu')}}">Quay về trang chủ</a>
	</span>
	<div class="clearfix"></div>
	<br>
</div>
@endsection