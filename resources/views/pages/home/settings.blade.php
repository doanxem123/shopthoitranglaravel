@extends('layout')
@section('content')
<?php

if(Session::get('account')){
	$account = Session::get('account');
}
?>
<!--content-->
<div class="contact">
	<div class="container">
		<h1>Thông tin người dùng</h1>
		<div class="contact-form">
			<div class="col-md-8 contact-grid">
				<form id="form1" action="{{URL::to('/update-account')}}" method="POST">
					{{ csrf_field() }}
					<b>Tên tài khoản : </b>
					<input type="text" value="{{$account->account_account}}" readonly>
					<b>Loại khách hàng : </b>
					<input type="text" value="{{$account->permission_name}}" readonly>
					<b>Họ và tên : </b>
					<input type="text" name="account_name_update" value="{{$account->account_name}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{$account->account_name}}';}">
					<b>Số điện thoại : </b>
					<input type="text" name="account_phone_update" value="{{$account->account_phone}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{$account->account_phone}}';}">
					<b>Email : </b>
					<input type="text" name="account_email_update" value="{{$account->account_email}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{$account->account_email}}';}">
					<b>Địa chỉ :</b>
					<input type="text" name="account_address_update" value="{{$account->account_address}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{$account->account_address}}';}">
					<div class="send">
						<input type="submit" value="Update">
					</div>
				</form>
				<div class="clearfix"></div>
				<br>
			</div>
			<div class="col-md-4 contact-in">
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--//content-->
	@endsection