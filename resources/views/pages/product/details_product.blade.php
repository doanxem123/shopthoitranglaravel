@extends('pages/layout_pages_withouthome')
@section('content2')
@foreach($product as $key => $item)
<div class="col-md-9 product-price1">
	<div class="col-md-5 single-top">	
		<div class="flexslider">
			<ul class="slides">
				@foreach($images as $key => $item2)
				<li data-thumb="{{URL::to('public/frontend/images/product/'.$item2->images_URL)}}">
					<img src="{{URL::to('public/frontend/images/product/'.$item2->images_URL)}}" style="height: 400px;max-height: 400px" />
				</li>
				@endforeach
			</ul>
		</div>
		<!-- FlexSlider -->
		<script defer src="{{asset('public/frontend/js/jquery.flexslider.js')}}"></script>
		<link rel="stylesheet" href="{{asset('public/frontend/css/flexslider.css')}}" type="text/css" media="screen" />

		<script>
			$(window).load(function() {
				$('.flexslider').flexslider({
					animation: "slide",
					controlNav: "thumbnails"
				});
			});
		</script>
	</div>	
	<div class="col-md-7 single-top-in simpleCart_shelfItem">
		<div class="single-para ">
			<h4 style="font-family: Times New Roman">{{$item->product_name}}</h4>
			@if($item->sales_rate == 0)
			<h5 class="item_price">{{number_format($item->product_price).' VNĐ'}}</h5>
			@else
			<h5 class="item_price"><strike>{{number_format($item->product_price).' VND'}}</strike>{{' -'.$item->sales_rate.'% '}} <br><br>{{number_format($item->product_price - $item->product_price*$item->sales_rate/100).' VND'}}</h5>
			@endif
			<p style="font-size:20px">{{$item->product_content}}</p>
		</div>
		<div style="font-size: 18px">
			<form id="form1" action="{{URL::to('/save-cart')}}" method="POST">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-3">
						<p>Cỡ : </p>
						<div class="clearfix"> </div>
						<br>
						<p>Số lượng : </p>
					</div>
					<div class="col-md-5" >
						<select id="select_size" onchange="size_quantity()" name="size_select" style="width: 100%">
							@foreach($details_product as $key => $item2)
							<option >{{$item2->size_name}}</option>
							@endforeach
						</select>
						<div class="clearfix"> </div>
						<br>
						<span>
							<input id="product_quantity" name="product_quantity" type="number" min="1" value="1" style="width: 100%" oninput="validity.valid||(value='');" />
							<input name="product_id_hidden" type="hidden" value="{{$item->product_id}}"/>
							<br>
						</span>
					</div>
					<div class="col-md-4">
						<p>&nbsp;</p>
						<div class="clearfix"> </div>
						<br>
						<p id="quantity" onload="size_quantity()"></p>
					</div>
				</div>
				<a href="#" id="buttonsubmit" class="add-cart item_add" onclick="BeforeAddtoCart()">Thêm vào giỏ hàng
				</a>

			</form>
		</div>
	</div>
	<div class="clearfix"> </div>
	<!---->
	<div>
		<h3>Giới thiệu sản phẩm :</h3>
		<div>
			{{$item->product_desc}}
		</div>
	</div>
</div>
<script>
	//first run
	var selectSize = document.getElementById("select_size").value;
		@foreach($details_product as $key => $item3)
			if(selectSize == '{{$item3->size_name}}'){
				if({{$item3->product_quantity }}==0){
					document.getElementById("buttonsubmit").innerHTML='Hết hàng';
					document.getElementById("buttonsubmit").setAttribute('onclick',null);
				}
				else{
					document.getElementById("buttonsubmit").innerHTML='Thêm vào giỏ hàng';
					document.getElementById("buttonsubmit").setAttribute('onclick','BeforeAddtoCart()');
				}
				document.getElementById("quantity").innerHTML = 'Còn {{$item3->product_quantity }} chiếc';
				document.getElementById("product_quantity").setAttribute('max','{{$item3->product_quantity}}');
			}
		@endforeach
	@if(Session::get('ThongBaoAddtoCart'))
		alert('{{Session::get('ThongBaoAddtoCart')}}');
		<?php
		Session::put('ThongBaoAddtoCart',null);
		?>
	@endif
	function size_quantity() {
		var selectSize = document.getElementById("select_size").value;
		@foreach($details_product as $key => $item3)
			if(selectSize == '{{$item3->size_name}}'){
				if({{$item3->product_quantity }}==0){
					document.getElementById("buttonsubmit").innerHTML='Hết hàng';
					document.getElementById("buttonsubmit").setAttribute('onclick',null);
				}
				else{
					document.getElementById("buttonsubmit").innerHTML='Thêm vào giỏ hàng';
					document.getElementById("buttonsubmit").setAttribute('onclick','BeforeAddtoCart()');
				}
				document.getElementById("quantity").innerHTML = 'Còn {{$item3->product_quantity }} chiếc';
				document.getElementById("product_quantity").setAttribute('max','{{$item3->product_quantity}}');
			}
		@endforeach
		
	}

	function BeforeAddtoCart(){
		var quantity = document.getElementById("product_quantity").value;
		var max_quantity = 0;
		var selectSize = document.getElementById("select_size").value;
		@foreach($details_product as $key => $item3)
			if(selectSize == '{{$item3->size_name}}'){
				max_quantity = {{$item3->product_quantity}};
			}
		@endforeach

		if(quantity <= max_quantity){
			document.getElementById('form1').submit()
		}
		else{
			alert('Số lượng lớn nhất có thể nhập là : '+max_quantity+' chiếc');
		}
		
	}
</script>
@endforeach
@endsection