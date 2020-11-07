@extends('layout')
@section('content')
<!--content-->
<!---->
<div class="product">
	<div class="container">
		<div class="col-md-3 product-price">
			<div class=" rsidebar span_1_of_left">
				<div class="of-left">
					<h3 class="cate">Danh mục sản phẩm </h3>
				</div>
				<ul class="menu">
					@foreach($category as $key => $cate)
					<li class="item1"><a href="#">{{$cate->category_name}}</a>
						<ul class="cute">
							@foreach($brand as $key => $bra)
							<li class="subitem1"><a href="{{URL::to('/show-filter-product/category='.$cate->category_id.'&brand='.$bra->brand_id)}}">+ {{$bra->brand_name}}</a>
							</li>
							@endforeach
						</ul>
					</li>
					@endforeach
				</ul>
			</div>

			<div class=" rsidebar span_1_of_left">
				<div class="of-left">
					<h3 class="cate">Thương hiệu sản phẩm </h3>
				</div>
				<ul class="menu">
					@foreach($brand as $key => $bra)
					<li class="item1"><a href="#">{{$bra->brand_name}}</a>
						<ul class="cute">
							@foreach($category as $key => $cate)
							<li class="subitem1"><a href="{{URL::to('/show-filter-product/category='.$cate->category_id.'&brand='.$bra->brand_id)}}">+ {{$cate->category_name}}</a>
							</li>
							@endforeach
						</ul>
					</li>
					@endforeach
				</ul>
			</div>

			<!--initiate accordion-->
			<script type="text/javascript">
				$(function() {
					var menu_ul = $('.menu > li > ul'),
					menu_a  = $('.menu > li > a');
					menu_ul.hide();
					menu_a.click(function(e) {
						e.preventDefault();
						if(!$(this).hasClass('active')) {
							menu_a.removeClass('active');
							menu_ul.filter(':visible').slideUp('normal');
							$(this).addClass('active').next().stop(true,true).slideDown('normal');
						} else {
							$(this).removeClass('active');
							$(this).next().stop(true,true).slideUp('normal');
						}
					});

				});
			</script>
			<!---->
			<div class="product-middle">
				<div class="fit-top">
					<h6 class="shop-top">Shop thời trang</h6>
					<a href="single.html" class="shop-now">SHOP NOW</a>
					<div class="clearfix"> </div>
				</div>
			</div>
			<!---->
		</div>
		@yield('content2')
	</div>
</div>

<!---->
<!--//content-->
@endsection