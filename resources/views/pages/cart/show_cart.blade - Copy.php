@extends('layout')
@section('content')
<?php
$account = Session::get('account');
$list = Cart::content();
$discount_code = Session::get('discount_code');
$discount_rate = Session::get('discount_rate');
$discount_message = Session::get('discount_message');

if($discount_code != null && $discount_rate != null){
	$discount_rate = '( - '.$discount_rate.' % )';
}
?>
<div class="container">
	<div class="check">	 
		<h1>Giỏ hàng của bạn ( {{count($list)}} )</h1>
		<div class="col-md-8 cart-items">
			@foreach($list as $item)
			<script>$(document).ready(function(c) {
				$('.close1').on('click', function(c){
					$('.cart-header').fadeOut('slow', function(c){
						$('.cart-header').remove();
					});
				});	  
			});
		</script>
		<div class="cart-header">
			<a href="{{URL::to('/update-cart/rowId='.$item->rowId.'&qty=delete')}}">
				<div class="close1">
				</div>
			</a>
			<div class="cart-sec simpleCart_shelfItem">
				<div class="cart-item cyc">
					<a href="{{URL::to('/product/id='.$item->options->product_id)}}">
						<img src="{{URL::to('public/frontend/images/product/'.$item->options->image)}}" class="img-responsive" alt=""/></a>
					</div>
					<div class="cart-item-info">
						<h3><a href="{{URL::to('/product/id='.$item->options->product_id)}}">{{$item->name}}</a></h3>
						<ul class="qty">
							<li>Size : {{$item->options->size}}
							</li>
							<li>
								
								<span>
									Số lượng : {{$item->qty}}
								</span>

								<span>&nbsp;</span>

								<span style="float:right">
									@if($item->qty > 1)
									<span style="float:left">
										<a class="cpns" href="{{URL::to('/update-cart/rowId='.$item->rowId.'&qty=-1')}}" style="text-decoration: none;">
											<span> - </span>
										</a>
									</span> 
									@endif
									<span>&nbsp;</span>
									@if($item->qty < $item->options->max_quantity)
									<span style="float:right">
										<a class="cpns" href="{{URL::to('/update-cart/rowId='.$item->rowId.'&qty=1')}}" style="text-decoration: none;">
											<span> + </span>
										</a>
									</span>
									@endif
								</span>
							</li>
							<li>
								<span>Còn {{$item->options->max_quantity}} chiếc</span>
							</li>
						</ul>
						@if($item->options->sale != 0)
						<div class="clearfix"></div>
						<br>
						<span>Khuyến mãi : - {{$item->options->sale}} % ( Giá gốc : {{number_format($item->price/(1-$item->options->sale/100)).' VND )'}}</span>
						@endif
						<div class="clearfix"></div>
						<br>
						<span style="font-size: 20px">Đơn giá : {{number_format($item->price).' VND'}}</span>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			@endforeach

		</div>
		<div class="col-md-4 cart-total">
			<div class="price-details">
				<?php
				$sum = 0;
				foreach($list as $item){
					$sum+=$item->price/(1-$item->options->sale/100)*$item->qty;
				}
				?>
				<h3>Thông tin giỏ hàng</h3>
				<span>Giá niêm yết : </span>
				<span class="total1">{{number_format($sum,2,'.',',').' VND'}}</span>
				<span>Khuyến mãi : </span>
				<span class="total1">{{'-'.number_format($sum-Cart::priceTotalFloat(),2,'.',',').' VND'}}</span>
				<span>
					Mã giảm giá {{$discount_rate}} :
				</span>
				@if($discount_code != null && $discount_rate != null)
				<span class="total1">
					-{{Cart::Discount().' VND'}} 
				</span>
				<span>
					Mã voucher : {{$discount_code}}
				</span>
				<span>
					<a href="#" onclick="document.getElementById('form2').submit()" >Xoá mã voucher</a>
					<form id="form2" action="{{URL::to('/check-discount')}}" method="POST">
						{{ csrf_field() }}
						<input name="discount_code" type="hidden" value=""/>
					</form>
				</span>
				@else
				<span class="total1">
					{{Cart::Discount().' VND'}}
				</span>
				@endif
				@if($account)
				<span>{{$account->permission_name}} ( - {{$account->permission_rate}} % ) : </span>
				<span class="total1">{{Cart::Tax().' VND'}}</span>
				@endif
				<div class="clearfix"></div>				 
			</div>	
			<ul class="total_price">
				<li class="last_price"> <h4>Tổng tiền</h4></li>	
				<li class="last_price"><span>{{Cart::total().' VND'}}</span></li>
				<div class="clearfix"> </div>
			</ul>

			<div class="clearfix"></div>
			@if($list->count()>0)
			<a class="order" href="{{URL::to('/show-checkout')}}">Đặt hàng</a>
			@else
			<a class="order" href="#">Bạn cần đặt sản phẩm vào giỏ hàng</a>
			@endif
			<form id="form1" action="{{URL::to('/check-discount')}}" method="POST">
				{{ csrf_field() }}
				<div class="total-item">
					<h3>Mã giảm giá </h3>
					<input name="discount_code" type="text" value="{{$discount_code}}"/>
					<br>
					<p>{{$discount_message}}</p>
					<br>
					<a class="cpns" href="#" onclick="document.getElementById('form1').submit()" >Sử dụng Voucher</a>
				</div>
			</form>
		</div>

		<div class="clearfix"> </div>
	</div>
</div>


<!--//content-->
@endsection