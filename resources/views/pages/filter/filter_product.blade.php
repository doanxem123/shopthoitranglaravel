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
					<h6 class="shop-top">Lorem Ipsum</h6>
					<a href="single.html" class="shop-now">SHOP NOW</a>
					<div class="clearfix"> </div>
				</div>
			</div>	 
			<div class="sellers">
				<div class="of-left-in">
					<h3 class="tag">Tags</h3>
				</div>
				<div class="tags">
					<ul>
						<li><a href="#">design</a></li>
						<li><a href="#">fashion</a></li>
						<li><a href="#">lorem</a></li>
						<li><a href="#">dress</a></li>
						<li><a href="#">fashion</a></li>
						<li><a href="#">dress</a></li>
						<li><a href="#">design</a></li>
						<li><a href="#">dress</a></li>
						<li><a href="#">design</a></li>
						<li><a href="#">fashion</a></li>
						<li><a href="#">lorem</a></li>
						<li><a href="#">dress</a></li>

						<div class="clearfix"> </div>
					</ul>

				</div>
			</div>
			<!---->
			<div class="product-bottom">
				<div class="of-left-in">
					<h3 class="best">Best Sellers</h3>
				</div>
				<div class="product-go">
					<div class=" fashion-grid">
						<a href="single.html"><img class="img-responsive " src="images/p1.jpg" alt=""></a>

					</div>
					<div class=" fashion-grid1">
						<h6 class="best2"><a href="single.html" >Lorem ipsum dolor sit
						amet consectetuer  </a></h6>

						<span class=" price-in1"> $40.00</span>
					</div>

					<div class="clearfix"> </div>
				</div>
				<div class="product-go">
					<div class=" fashion-grid">
						<a href="single.html"><img class="img-responsive " src="images/p2.jpg" alt=""></a>

					</div>
					<div class="fashion-grid1">
						<h6 class="best2"><a href="single.html" >Lorem ipsum dolor sit
						amet consectetuer </a></h6>

						<span class=" price-in1"> $40.00</span>
					</div>

					<div class="clearfix"> </div>
				</div>

			</div>
			<div class=" per1">
				<a href="single.html" ><img class="img-responsive" src="images/pro.jpg" alt="">
					<div class="six1">
						<h4>DISCOUNT</h4>
						<p>Up to</p>
						<span>60%</span>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-9 product1">
			<div class=" bottom-product">
				@foreach($filter_by_id as $key => $item)
				<div class="col-md-4 bottom-cd simpleCart_shelfItem">
					<div class="product-at">
						<a href="single.html"><img class="img-responsive" src="{{URL::to('public/frontend/images/demo/'.$item->product_image)}}" alt="" style="height: 255px;width:255px">
							<div class="pro-grid">
								<span class="buy-in">{{$item->product_name}}</span>
							</div>
						</a>	
					</div>

					<!-- <p class="tun">{{$item->product_price}} VND</p> -->
					<br>
					<a href="#" class="item_add"><p class="number item_price"><i> </i>Thêm vào giỏ hàng<br>{{$item->product_price}} VND</p></a>		
					<br>
				</div>
				@endforeach
				
				<div class="clearfix"> </div>
			</div>
		</div>	



		<div class="clearfix"> </div>
		<nav class="in">
			<ul class="pagination">
				{!! $filter_by_id->links() !!}
			</ul>
		</nav>
	</div>
</div>


<!---->
<!--//content-->
@endsection