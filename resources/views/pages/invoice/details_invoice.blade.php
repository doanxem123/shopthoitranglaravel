@extends('layout')
@section('content')
<?php

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
					<th scope="col">Khuyến mãi</th>
					<th scope="col">Tổng tiền</th>
				</tr>
			</thead>
			<tbody>
				@foreach($details_invoice as $key => $item)
				<tr>
					<th scope="row">{{$dem++}}</th>
					<td><a href="{{URL::to('/product/id='.$item->product_id)}}">
						<img src="{{URL::to('public/frontend/images/product/'.$item->images_URL)}}" class="img-responsive" alt="" width="40" />
					</a></td>
					<td>
						<a href="{{URL::to('/product/id='.$item->product_id)}}">
							{{$item->product_name}}
						</a>
					</td>
					<td>{{$item->size_name}}</td>
					<td>{{$item->details_invoice_quantity}}</td>
					<td>{{number_format($item->product_price).' VND'}}</td>
					<td>{{$item->sales_rate}} %</td>
					<td>{{number_format($item->details_invoice_price).' VND'}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="clearfix"></div>
		@foreach($invoice as $key => $item)
		<div class="col-md-4">
			<div>
				<p>Ghi chú của người đặt :</p>
				<textarea name="invoice_note" cols="40" rows="4" readonly>{{$item->invoice_note}}</textarea>
			</div>
		</div>
		<div class="col-md-4">
			<div>
				<p>Ghi chú chỉnh sửa trạng thái :</p>
				<textarea cols="40" rows="4" readonly>{{$item->invoice_desc}}</textarea>
			</div>
		</div>
		<div class="col-md-4">
			<div style="float:right;">
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
				<br>
				<p>
					@if(Session::get('account') && Session::get('account')->permission_id==1)

					@if($item->invoice_status == 0)	
					<p style="float:right">Trạng thái : Chờ xác nhận</p>
					<div class="clearfix"></div>
					<button type="button" onclick="update_status({{$item->invoice_id}},3)" class="btn btn-danger" style="float:right">Huỷ bỏ</button>
					<button type="button"  onclick="update_status({{$item->invoice_id}},1)" class="btn btn-success" style="float:right" >Xác nhận</button>
					<div class="clearfix"></div>
					<form id="form_desc" action="#" method="POST">
						{{ csrf_field() }}
						<p style="float:right">
							<input type="checkbox" onchange="changeCB()" id="cbLiDo"><span> Ghi chú</span>
							<input type="hidden" id="invoice_desc" name="invoice_desc" />
						</p>
					</form>
					@endif

					@if($item->invoice_status == 1)	
					<p style="float:right">Trạng thái : Đã hoàn Thành</p>
					@endif

					@if($item->invoice_status == 2)	
					<p style="float:right">Trạng thái : Chờ huỷ</p>
					<div class="clearfix"></div>
					<button type="button" onclick="update_status({{$item->invoice_id}},0)" class="btn btn-danger" style="float:right">Huỷ bỏ</button>
					<button type="button" onclick="update_status({{$item->invoice_id}},3)" class="btn btn-success" style="float:left" >Xác nhận</button>
					<div class="clearfix"></div>
					<form id="form_desc" action="#" method="POST">
						{{ csrf_field() }}
						<p style="float:right">
							<input type="checkbox" onchange="changeCB()" id="cbLiDo"><span> Ghi chú</span>
							<input type="hidden" id="invoice_desc" name="invoice_desc" />
						</p>
					</form>

					@endif

					@if($item->invoice_status == 3)	
					<p style="float:right">Trạng thái : Đã huỷ</p>
					@endif

					@else

					@if($item->invoice_status == 0)	
					<p style="float:right">Trạng thái : Chờ xác nhận</p>
					<div class="clearfix"></div>
					<button type="button" onclick="update_status({{$item->invoice_id}},2)" class="btn btn-danger" style="float:right">Huỷ bỏ</button>
					<div class="clearfix"></div>
					<form id="form_desc" action="#" method="POST">
						{{ csrf_field() }}
						<p style="float:right">
							<input type="checkbox" onchange="changeCB()" id="cbLiDo"><span> Ghi chú</span>
							<input type="hidden" id="invoice_desc" name="invoice_desc" />
						</p>
					</form>

					@endif

					@if($item->invoice_status == 1)	
					<p style="float:right">Trạng thái : Đã hoàn Thành</p>
					@endif

					@if($item->invoice_status == 2)	
					<p style="float:right">Trạng thái : Chờ huỷ</p>
					<div class="clearfix"></div>
					<button type="button" onclick="update_status({{$item->invoice_id}},0)" class="btn btn-warning" style="float:right">Hoàn tác</button>
					<div class="clearfix"></div>
					<form id="form_desc" action="#" method="POST">
						{{ csrf_field() }}
						<p style="float:right">
							<input type="checkbox" onchange="changeCB()" id="cbLiDo"><span> Ghi chú</span>
							<input type="hidden" id="invoice_desc" name="invoice_desc" />
						</p>
					</form>
					@endif

					@if($item->invoice_status == 3)	
					<p style="float:right">Trạng thái : Đã huỷ</p>
					@endif

					@endif
				</p>

			</p>
		</div>
	</div>
	@endforeach
</div>
</div>

<script>
	function changeCB() {
		var checkBox = document.getElementById("cbLiDo");
		if(checkBox.checked == true){
			var txt = prompt("Hãy viết ghi chú :");
			if (txt != null && txt != "") {
				document.getElementById("invoice_desc").setAttribute("value",txt);
			}
			else{
				document.getElementById("invoice_desc").setAttribute("value",null);
				document.getElementById("cbLiDo").checked = false;
			}
		}
		else{
			document.getElementById("invoice_desc").setAttribute("value",null);
		}
	}

	function update_status($id,$status){
		document.getElementById("form_desc").setAttribute('action',"{{URL::to('/update-invoice/id=')}}"+$id+"&status="+$status);
		document.getElementById('form_desc').submit();
	}

</script>


@endsection