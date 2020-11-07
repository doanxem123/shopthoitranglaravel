@extends('pages/layout_pages_withouthome')
@section('content2')
<div class="col-md-9 product1">
	<div class=" bottom-product">
		@if($search_keywords)
			<h3>Kết quả tìm kiếm : {{$search_keywords}}</h3>
			<h3>Số Kết quả tìm kiếm : {{$number}}</h3>
			<br>
		@endif
		@foreach($filter as $key => $item)
		<div class="col-md-4 bottom-cd simpleCart_shelfItem">
			<div class="product-at">
				<a href="{{URL::to('/product/id='.$item->product_id)}}"><img class="img-responsive" src="{{URL::to('public/frontend/images/demo/'.$item->product_image)}}" alt="" style="height: 255px;width:255px">
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
		{!! $filter->links() !!}
	</ul>
</nav>
@endsection