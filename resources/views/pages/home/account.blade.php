@extends('layout')
@section('content')
<?php
$account = Session::get('account');
if($account){
	$account_name = $account->account_name;
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
					<th scope="col">Mã đơn hàng</th>
					<th scope="col">Họ và tên</th>
					<th scope="col">Số điện thoại</th>
					<th scope="col">Email</th>
					<th scope="col">Địa chỉ</th>
					<th scope="col">Tổng tiền</th>
					<th scope="col">Ngày tạo</th>
					<th scope="col">Handle</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$dem=1;
				?>
				@foreach($invoice as $key => $item)
				<tr>
					<th scope="row">{{$dem++}}</th>
					<td>
						<a href="#">
							{{$item->invoice_id}}
						</a>
					</td>
					<td>{{$item->invoice_account_name}}</td>
					<td>{{$item->invoice_account_phone}}</td>
					<td>{{$item->invoice_account_email}}</td>
					<td>{{$item->invoice_account_address}}</td>
					<td>{{$item->invoice_total}}</td>
					<td>{{$item->created_at}}</td>
					<td>@mdo</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


@endsection