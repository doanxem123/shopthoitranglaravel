@extends('layout')
@section('content')
<div>
	<br>
	<span>
		Cảm ơn bạn đã mua và đặt hàng của chúng tôi với mã đơn hàng : <b style="font-size: 30px">{{$last_invoice->invoice_id}} </b>, xem lại <a href="{{URL::to('/invoice')}}">Đơn hàng</a> hoặc quay về <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
	</span>
	<div class="clearfix"></div>
	<br>
</div>
@endsection