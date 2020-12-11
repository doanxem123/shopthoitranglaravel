@extends('layout')
@section('content')
<?php

?>
<div class="contact">
	<div class="container">
		<h1>Thông tin đơn hàng</h1>
		<br>
		<div>Tìm kiếm cục bộ : <input type="text" id="search-all" placeholder="Tìm kiếm ..."> <span id="SoKetQuaTimKiem"></span></div>
		<form id="form_desc" action="#" method="POST">
			{{ csrf_field() }}
			<p style="float:right">
				<textarea cols="40" rows="2" readonly id="txtGhiChu"></textarea>
				<input type="checkbox" onchange="changeCB()" id="cbLiDo"><span> Ghi chú</span>
				<input type="hidden" id="invoice_desc" name="invoice_desc" />
			</p>
		</form>
		<div class="clearfix"></div>
		<table class="table table-bordered" id="show-table">
			<thead>
				<tr>
					<form id="form1" action="{{ URL::to('/show-filter-invoice') }}" method="POST">
						{{ csrf_field() }}
						<th scope="col"><input type="checkbox" id="checkall" onchange="check_all()"></th>
						<th scope="col"><input type="text" name="searchid" placeholder="Mã đơn hàng" style="width: 100px"></th>
						<th scope="col"><input type="text" name="searchname" placeholder="Họ và tên" ></th>
						<th scope="col"><input type="text" name="searchphone" placeholder="Số điện thoại" style="width: 100px" ></th>
						<th scope="col"><input type="text" name="searchemail" placeholder="Email" ></th>
						<th scope="col"><input type="text" name="searchaddress" placeholder="Địa chỉ" style="width: 100px"></th>
						<th scope="col"><input type="text" name="searchtotal" placeholder="Tổng tiền" style="width: 100px"></th>
						<th scope="col"><input type="text" name="searchtime" placeholder="Ngày tạo" style="width: 150px"></th>
						<th scope="col"><input type="submit" name="searchbutton" value="Tìm kiếm" style="width: 100px"></th>
					</form>
				</tr>
			</thead>
			<tbody>
				@if($invoice)
				@foreach($invoice as $key => $item)
				<tr class="search-table">
					<th scope="row"><input type="checkbox" id="checkbox[{{$item->invoice_id}}]" name="checkbox[]" value="{{$item->invoice_id}}"></th>
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
					@if(Session::get('account') && Session::get('account')->permission_id == 1)

					@if($item->invoice_status==0)
					<td style="background-color: lightblue">
						<p>{{$status}}</p>
						<a onclick="update_status({{$item->invoice_id}},1)" href="#" value="{{$item->invoice_status}}">Xác nhận</a>
						<br>
						<a onclick="update_status({{$item->invoice_id}},3)" href="#" value="{{$item->invoice_status}}">Huỷ bỏ</a>
					</td>
					@endif

					@if($item->invoice_status==1)
					<td style="background-color: lightgreen">
						<p>{{$status}}</p>
					</td>
					@endif

					@if($item->invoice_status==2)
					<td style="background-color: yellow">
						<p>{{$status}}</p>
						<a onclick="update_status({{$item->invoice_id}},3)" href="#" value="{{$item->invoice_status}}">Xác nhận</a>
						<br>
						<a onclick="update_status({{$item->invoice_id}},0)" href="#" value="{{$item->invoice_status}}">Huỷ bỏ</a>
					</td>
					@endif

					@if($item->invoice_status==3)
					<td style="background-color: red">
						<p>{{$status}}</p>
					</td>
					@endif

					@else

					@if($item->invoice_status==0)
					<td style="background-color: lightblue">
						<p>{{$status}}</p>
						<a onclick="update_status({{$item->invoice_id}},2)" href="#" value="{{$item->invoice_status}}">Huỷ đơn</a>	
					</td>
					@endif

					@if($item->invoice_status==1)
					<td style="background-color: lightgreen">
						<p>{{$status}}</p>
					</td>
					@endif

					@if($item->invoice_status==2)
					<td style="background-color: yellow">
						<p>{{$status}}</p>
						<a onclick="update_status({{$item->invoice_id}},0)" href="#" value="{{$item->invoice_status}}">Hoàn tác</a>	
					</td>
					@endif

					@if($item->invoice_status==3)
					<td style="background-color: red">
						<p>{{$status}}</p>
					</td>
					@endif

					@endif
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
	
	@if($invoice)
	<nav class="in">
		<div>
			@if(Session::get('account') && Session::get('account')->permission_id == 1)
			<button type="button" onclick="checkbox_ajax(1)" class="btn btn-success">Xác nhận</button>
			<button type="button" onclick="checkbox_ajax(2)" class="btn btn-warning">Huỷ bỏ</button>
			<button type="button" onclick="checkbox_ajax(3)" class="btn btn-danger">Xoá</button>
			<input type="hidden" id="listid">
			@endif
		</div>
		<ul class="pagination">
			{!! $invoice->links() !!}
		</ul>
	</nav>
	@endif
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
	//checkbox ghi chú
	function changeCB(){
		var checkBox = document.getElementById("cbLiDo");
		if(checkBox.checked == true){
			var txt = prompt("Hãy viết ghi chú :");
			if (txt != null && txt != "") {
				document.getElementById("invoice_desc").setAttribute("value",txt);
				document.getElementById("txtGhiChu").value=txt;
			}
			else{
				document.getElementById("invoice_desc").setAttribute("value",null);
				document.getElementById("cbLiDo").checked = false;
			}
		}
		else{
			document.getElementById("invoice_desc").setAttribute("value",null);
			document.getElementById("txtGhiChu").value=txt;
		}
	}

	//Post form update
	function update_status($id,$status){
		document.getElementById("form_desc").setAttribute('action',"{{URL::to('/update-invoice/id=')}}"+$id+"&status="+$status);
		document.getElementById('form_desc').submit();
	}

	function check_all(){
        // Lấy danh sách checkbox
        var checkboxes = document.getElementsByName('checkbox[]');
        var checkall = document.getElementById("checkall");
        if(checkall.checked==true){
        	// Lặp và thiết lập checked
        	for (var i = 0; i < checkboxes.length; i++){
        		checkboxes[i].checked = true;
        	}
        }
        else{
        	// Lặp và thiết lập checked
        	for (var i = 0; i < checkboxes.length; i++){
        		checkboxes[i].checked = false;
        	}
        }
    }
    //AJAX
    function checkbox_ajax(code){
    	var list_id = [];
    	var checkboxes = document.getElementsByName('checkbox[]');
    	if(checkboxes.length==0 || checkboxes == null){
    		return alert('Mời bạn chọn ô cần thực hiện');
    	}
    	var dem=0;
    	for (var i = 0; i < checkboxes.length; i++){
    		if(checkboxes[i].checked == true){
    			var id = checkboxes[i].value;
    			list_id.push(id);
    		}
    		else{
    			dem++;
    		}
    	}
    	if(dem==checkboxes.length){
    		return alert('Mời bạn chọn ô cần thực hiện');
    	}
    	var invoice_desc = document.getElementById("invoice_desc").value;

    	var frmData = new FormData();
    	frmData.append('list_id', list_id);
    	frmData.append('invoice_desc', invoice_desc);
    	frmData.append('code', code);

    	$.ajaxSetup({
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
    	});

    	$.ajax({
    		type: "POST",
    		contentType: false,
    		processData: false,
    		url: "{{URL::to('/checkbox-ajax')}}",
    		data: frmData,
    		dataType: "json",
    		success: function (data) {
    			if (data != null && data != '') {
    				window.location.reload();
    			}
    			else{
    				alert(data);
    			}
    		},
    		error: function (xhr, ajaxOptions, thrownError) {
    			alert(xhr.responseText);
    		}
    	});
    }
</script>



@endsection