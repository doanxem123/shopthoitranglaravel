@extends('layout')
@section('content')
<?php
$account = Session::get('account');
if($account){
	$account_name = $account->account_name;
}

$dem=1;
$sum = 0;
$sum_1=0;
foreach($details_invoice as $item){
	$sum+=$item->details_invoice_price;
}
$afterdiscount=0;
foreach($invoice as $item){
	if($item->discount_id != 0){
		$discount_info = '( '.$item->discount_code.' ) ( - '.$item->discount_rate.' % )';
		$sum_1 = -$sum*$item->discount_rate/100;
	}
	else{
		$discount_info = '';
	}
}
$sum_2 = $sum + $sum_1;
foreach($invoice_permission as $item1){
	$permission = $item1->permission_name.' ( - '.$item1->permission_rate.' % ) : - '.number_format($sum_2*$item1->permission_rate/100).' VND';
}


?>
<div class="contact">
	<div class="container">
		<h1>Thông tin đơn hàng</h1>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">STT</th>
					<th scope="col">Ảnh</th>
					<th scope="col">Tên sản phẩm</th>
					<th scope="col">Size</th>
					<th scope="col">Số lượng</th>
					<th scope="col">Giá</th>
					<th scope="col">Tổng tiền</th>
				</tr>
			</thead>
			<tbody>
				@foreach($details_invoice as $key => $item)
				<tr>
					<th scope="row">{{$dem++}}</th>
					<td><a href="{{URL::to('/product/id='.$item->product_id)}}">
							<img src="{{URL::to('public/frontend/images/demo/'.$item->images_URL)}}" class="img-responsive" alt="" width="40" />
						</a></td>
					<td>
						<a href="{{URL::to('/product/id='.$item->product_id)}}">
							{{$item->product_name}}
						</a>
					</td>
					<td>{{$item->size_name}}</td>
					<td>{{$item->details_invoice_quantity}}</td>
					<td>{{number_format($item->product_price).' VND'}}</td>
					<td>{{number_format($item->details_invoice_price).' VND'}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="clearfix"></div>
		<div style="float:right;">
			@foreach($invoice as $key => $item)
			<p style="float:right;">
				Thành tiền : {{number_format($sum).' VND'}}
			</p>
			<br>
			<p style="float:right;">
				Giảm giá {{$discount_info}} : {{number_format($sum_1).' VND'}}
			</p>
			<br>
			<p style="float:right;">
				{{$permission}}
			</p>
			<br>
			<b style="float:right;">
				Tổng tiền : {{number_format($item->invoice_total).' VND'}}
			</b>
			@endforeach
		</div>
	</div>
</div>


@endsection