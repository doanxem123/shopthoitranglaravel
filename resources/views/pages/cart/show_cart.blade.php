@extends('layout')
@section('content')
<?php
$list = Cart::content();
?>
<div class="container">
	<div class="check">	 
		<h1>Giỏ hàng của bạn ( {{count($list)}} )</h1>
		<div class="col-md-9 cart-items">

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
					<a href="{{URL::to('/product/id='.$item->id)}}">
						<img src="{{URL::to('public/frontend/images/demo/'.$item->options->image)}}" class="img-responsive" alt=""/></a>
					</div>
					<div class="cart-item-info">
						<h3><a href="{{URL::to('/product/id='.$item->id)}}">{{$item->name}}</a></h3>
						<ul class="qty">
							<li>Size : {{$item->options->size}}
							</li>
							<li>
								<span>
									Số lượng : {{$item->qty}}    
								</span>
								<span>&nbsp;</span>
								<span style="float:right">
									<span style="float:left">
										<a class="cpns" href="{{URL::to('/update-cart/rowId='.$item->rowId.'&qty=-1')}}">
											<span> - </span>
										</a>
									</span> 
									<span>&nbsp;</span>
									<span style="float:right">
										<a class="cpns" href="{{URL::to('/update-cart/rowId='.$item->rowId.'&qty=1')}}">
											<span> + </span>
										</a>
									</span>
								</span>
							</li>
						</ul>
						<div class="clearfix"></div>
						<br>
						<span style="font-size: 25px">Giá : {{number_format($item->price).' VND'}}</span>
					</div>
					<div class="clearfix"></div>

				</div>
			</div>
			@endforeach

		</div>
		<?php
			$sum = 0;
			foreach($list as $item){
				$sum+=$item->price*$item->qty;
			}
			$total = $sum - ( $sum * 1);
		?>
		<div class="col-md-3 cart-total">
			<div class="price-details">
				<h3>Thông tin giỏ hàng</h3>
				<span>Tổng tiền</span>
				<span class="total1">{{number_format($sum).' VND'}}</span>
				<span>Voucher</span>
				<span class="total1">---</span>
				<div class="clearfix"></div>				 
			</div>	
			<ul class="total_price">
				<li class="last_price"> <h4>Tổng tiền</h4></li>	
				<li class="last_price"><span>{{number_format($sum).' VND'}}</span></li>
				<div class="clearfix"> </div>
			</ul>


			<div class="clearfix"></div>
			<a class="order" href="#">Place Order</a>
			<div class="total-item">
				<h3>OPTIONS</h3>
				<h4>COUPONS</h4>
				<a class="cpns" href="#">Apply Coupons</a>
				<p><a href="#">Log In</a> to use accounts - linked coupons</p>
			</div>
		</div>

		<div class="clearfix"> </div>
	</div>
</div>


<!--//content-->
@endsection