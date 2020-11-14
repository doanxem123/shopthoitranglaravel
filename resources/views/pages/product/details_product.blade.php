@extends('pages/layout_pages_withouthome')
@section('content2')
@foreach($product as $key => $item)
<div class="col-md-9 product-price1">
	<div class="col-md-5 single-top">	
		<div class="flexslider">
			<ul class="slides">
				@foreach($images as $key => $item2)
				<li data-thumb="{{URL::to('public/frontend/images/demo/'.$item2->images_URL)}}">
					<img src="{{URL::to('public/frontend/images/demo/'.$item2->images_URL)}}" style="height: 400px;max-height: 400px" />
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

			<h5 class="item_price">{{number_format($item->product_price).' VNĐ'}}</h5>
			<p>{{$item->product_content}}</p>
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
						<select name="size_select" style="width: 100%">
							@foreach($size as $key => $item2)
							<option >{{$item2->size_name}}</option>
							@endforeach
						</select>
						<div class="clearfix"> </div>
						<br>
						<span>
							<input name="product_quantity" type="number" min="1" value="1" style="width: 100%" oninput="validity.valid||(value='');" />
							<input name="product_id_hidden" type="hidden" value="{{$item->product_id}}"/>
							<br>
						</span>
					</div>
				</div>
				<input name="page" type="hidden" value="next"/>
				<a href="#" class="add-cart item_add" onclick="document.getElementById('form1').submit()">Thêm vào giỏ hàng
				</a>
			</form>
		</div>
	</div>
	<div class="clearfix"> </div>
	<!---->

</div>
@endforeach
@endsection