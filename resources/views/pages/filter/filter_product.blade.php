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
				<a href="{{URL::to('/product/id='.$item->product_id)}}"><img class="img-responsive" src="{{URL::to('public/frontend/images/demo/'.$item->images_URL)}}" alt="" style="height: 255px;width:255px">
					<div class="pro-grid">
						<span class="buy-in">Xem Sản Phẩm</span>
					</div>
				</a>
			</div>

			<br>
				<a class="item_add" href="{{URL::to('/product/id='.$item->product_id)}}">
				<p class="number item_price">{{$item->product_name}}<br>{{number_format($item->product_price).' VNĐ'}}</p>
				</a>
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