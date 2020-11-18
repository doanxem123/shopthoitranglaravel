@extends('layout')
@section('content')
<?php
if(Session::get('account')){
	$account = Session::get('account');
}
?>
<div class="contact">
	<div class="container">
		<h1>Thông tin đơn hàng</h1>
		<br>
		<div>Tìm kiếm cục bộ : <input type="text" id="search-all" placeholder="Tìm kiếm ..."> <span id="SoKetQuaTimKiem"></span></div>
		<br>
		<table class="table table-bordered" id="show-table">
			<thead>
				<tr>
					<th scope="col">STT</th>
					<th scope="col"><input type="text" id="search-id" placeholder="Mã đơn hàng" style="width: 100px"></th>
					<th scope="col"><input type="text" id="search-name" placeholder="Họ và tên" ></th>
					<th scope="col"><input type="text" id="search-phone" placeholder="Số điện thoại" style="width: 100px" ></th>
					<th scope="col"><input type="text" id="search-email" placeholder="Email" ></th>
					<th scope="col"><input type="text" id="search-address" placeholder="Địa chỉ" style="width: 100px"></th>
					<th scope="col"><input type="text" id="search-total" placeholder="Tổng tiền" style="width: 100px"></th>
					<th scope="col"><input type="text" id="search-time" placeholder="Ngày tạo" style="width: 150px"></th>
					<th scope="col"><input type="submit" id="search-button" value="Tìm kiếm" style="width: 100px"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$dem=1;
				?>
				
				@foreach($invoice as $key => $item)
				@if($item->account_id != 2)
				<tr class="search-table">
					<th scope="row">{{$dem++}}</th>
					<td class="search-id">
						<a href="{{URL::to('/details-invoice/id='.$item->invoice_id)}}">
							{{$item->invoice_id}}
						</a>
					</td>
					<td class="search-name" >{{$item->invoice_account_name}}</td>
					<td class="search-phone">{{$item->invoice_account_phone}}</td>
					<td class="search-email">{{$item->invoice_account_email}}</td>
					<td class="search-address">{{$item->invoice_account_address}}</td>
					<td class="search-total">{{number_format($item->invoice_total).' VND'}}</td>
					<td class="search-time">{{$item->created_at}}</td>
					<?php
					$status='';
					if($item->invoice_status==0){
						$status='Chờ xác nhận';
					}
					else if($item->invoice_status==1){
						$status='Đã hoàn thành';
					}
					else if($item->invoice_status==2){
						$status='Chờ huỷ';
					}
					else if($item->invoice_status==3){
						$status='Đã huỷ';
					}
					?>
					@if(Session::get('account')->permission_id == 1)
					@if($item->invoice_status==0)
					<td style="background-color: lightblue">
						<p>{{$status}}</p>
						<a href="{{URL::to('/update-invoice/invoiceId='.$item->invoice_id.'&status=1')}}" value="{{$item->invoice_status}}">Hoàn thành</a>
					</td>
					@elseif($item->invoice_status==2)
					<td style="background-color: yellow">
						<p>{{$status}}</p>
						<a href="{{URL::to('/update-invoice/invoiceId='.$item->invoice_id.'&status=3')}}" value="{{$item->invoice_status}}">Đồng ý</a>
						<a href="{{URL::to('/update-invoice/invoiceId='.$item->invoice_id.'&status=3')}}" value="{{$item->invoice_status}}">Huỷ bỏ</a>
					</td>
					@else
					<td>
						<p>{{$status}}</p>
					</td>
					@endif
					@else
					@if($item->invoice_status==0)
					<td>
						<p>{{$status}}</p>
						<a href="{{URL::to('/update-invoice/invoiceId='.$item->invoice_id.'&status=2')}}" value="{{$item->invoice_status}}" style="color:red">Huỷ</a>	
					</td>
					@else
					<td>
						<p>{{$status}}</p>
					</td>
					@endif
					@endif
				</tr>
				@endif
				@endforeach
			</tbody>
		</table>
	</div>
	<div>
		<button submit>
		</div>
		<nav class="in">
			<ul class="pagination">
				{!! $filter->links() !!}
			</ul>
		</nav>
	</div>

	<script>
	//Tìm kiếm tất cả thông tin 
	function Contains(text_one, text_two) {
		if (text_one.indexOf(text_two) != -1) {
			return true;
		}
	}

	$("#search-all").keyup(function () {
		var x = $("#search-all").val().toLowerCase();
		var dem = 0;
		$(".search-table").each(function () {
			if (!Contains($(this).text().toLowerCase(), x)) {
				$(this).hide();
			}
			else {
				dem++;
				$(this).show();
			}
		});

		$("#SoKetQuaTimKiem").html("Có " + dem + " kết quả tìm thấy ");
	});
</script>

<script>
	$(document).ready(function(){
		$("#search-button").click(function(){ 
			var searchid = $("#search-id").val();
			var searchname = $("#search-name").val();
			var searchphone = $("#search-phone").val();
			var searchemail = $("#search-email").val();
			var searchaddress = $("#search-address").val();
			var searchtotal = $("#search-total").val();
			var searchtime = $("#search-time").val();

			var frmData = new FormData();
			frmData.append('searchid', searchid);
			frmData.append('searchname', searchname);
			frmData.append('searchphone', searchphone);
			frmData.append('searchemail', searchemail);
			frmData.append('searchaddress', searchaddress);
			frmData.append('searchtotal', searchtotal);
			frmData.append('searchtime', searchtime);

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: "POST",
				contentType: false,
				processData: false,
				url: "{{URL::to('/show-filter-invoice')}}",
				data: frmData,
				dataType: "json",
				success: function (data) {
					if (data != null) {
						$('#show-table tbody').empty();
						$('#show-table tbody').append(data);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					$('#show-table tbody').empty();
					$('#show-table tbody').append(xhr.responseText);
				}
			});
		});
	});
</script>


@endsection