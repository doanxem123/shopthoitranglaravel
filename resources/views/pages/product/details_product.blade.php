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
// Can also be used with $(document).ready()
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
		<h4>{{$item->product_name}}</h4>

		<h5 class="item_price">{{$item->product_price}} VND</h5>
		<p>{{$item->product_content}}</p>
		<div class="available">
			<ul>
				<li class="size-in">Cỡ
					<select>
						@foreach($size as $key => $item)
						<option>{{$item->size_name}}</option>
						@endforeach
					</select>
				</li>
				<div class="clearfix"> </div>
			</ul>
		</div>
		<a href="#" class="add-cart item_add">ADD TO CART</a>

	</div>
</div>
<div class="clearfix"> </div>
<!---->

</div>
@endforeach
@endsection