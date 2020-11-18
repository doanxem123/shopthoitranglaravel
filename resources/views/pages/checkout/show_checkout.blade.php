@extends('layout')
@section('content')
<?php
$account = Session::get('account');
$list = Cart::content();
?>
<!--content-->
<div class="contact">
	<div class="container">
		<h1>
            Thông tin đặt hàng
        </h1>

        <div class="contact-form">
            <div class="col-md-8 contact-grid">
                @if($account == null)
                <div>
                    <span>
                        <a href="{{URL::to('/login')}}">Đăng nhập hoặc đăng ký</a>
                         để tích điểm và lưu thông tin đặt hàng </span>
                    <br>
                    <br>
                </div>
                @endif
                <form id="form_checkout" action="{{ URL::to('/send-checkout') }}" method="POST">
                    {{ csrf_field() }}
                    @if($account)
                    <b>
                        Họ và tên người nhận :
                    </b>
                    <input type="text" id="account_name" name="account_name" value="{{$account->account_name}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{$account->account_name}}';}">
                    <b>
                        Số điện thoại :
                    </b>
                    <input type="text" id="account_phone" name="account_phone" value="{{$account->account_phone}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{$account->account_phone}}';}">
                    <b>
                        Email :
                    </b>
                    <input type="text" id="account_email" name="account_email" value="{{$account->account_email}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{$account->account_email}}';}">
                    <b>
                        Địa chỉ :
                    </b>
                    <input type="text" id="account_address" name="account_address" value="{{$account->account_address}}" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='{{$account->account_address}}';}">

                    @else
                    <b>
                        Họ và tên người nhận :
                    </b>
                    <input type="text" id="account_name" name="account_name">
                    <b>
                        Số điện thoại :
                    </b>
                    <input type="text" id="account_phone" name="account_phone">
                    <b>
                        Email :
                    </b>
                    <input type="text" id="account_email" name="account_email">
                    <b>
                        Địa chỉ :
                    </b>
                    <input type="text" id="account_address" name="account_address">
                    @endif
                    <b>
                        Ghi chú :
                    </b>
                    <textarea name="invoice_note" cols="77" rows="6"></textarea>
                    <div id="txtThongBao" style="color:red"></div>
                    <br>
                    <div class="send">
                        <button type="button" id="checkout-submit">Đặt hàng</button>
                    </div>
                </form>

                <div class="clearfix"></div>
                <br/>
            </div>
            <div class="col-md-4 contact-in">
                <div class="address-more">
                    <h2>
                        Hoá Đơn
                    </h2>
                    <br>
                    @foreach($list as $item)
                    <b>{{$item->name}}</b>
                    <p>
                        <span>
                            Size : {{$item->options->size}} 
                        </span>
                        <span style="float:right">
                            {{number_format($item->price).' VND'}}
                        </span>
                        <span style="float:right;font-size:12px">
                            &nbsp;x&nbsp;
                        </span>
                        <span style="float:right"> {{$item->qty}} </span>
                    </p>
                    <br>
                    @endforeach
                    <p>-----------------------------------------------------------------</p>
                    <?php
                    $sum = 0;
                    foreach($list as $item){
                        $sum+=$item->price*$item->qty;
                    }
                    ?>
                    <br>
                    <p>
                        <span>Tổng tiền : </span>
                        <span style="float:right">{{Cart::priceTotal().' VND'}}</span>
                    </p>
                    <p>
                        <span>Mã giảm giá : </span>
                        <span style="float:right">-{{Cart::discount().' VND'}}</span>
                    </p>
                    @if($account)
                    <p>
                        <span>{{$account->permission_name}} :</span>
                        <span style="float:right">{{Cart::tax().' VND'}}</span>
                    </p>
                    @endif
                    <p>
                        <span>Tổng tiền thực : </span>
                        <span style="float:right">{{Cart::total().' VND'}}</span>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //Xử lý thêm mới
        $('#checkout-submit').click(function () {
            //Lấy thông tin
            var account_name = $("#account_name").val();
            var account_phone = $("#account_phone").val();
            var account_email = $("#account_email").val();
            var account_address = $("#account_address").val();
            var ThongBao = "";

            if (account_name == null || account_name.length == 0 || account_name=="") {
                ThongBao += " - Bạn cần phải nhập thông tin họ và tên <br>";
            }
            if (account_phone == null || account_phone.length == 0 || account_phone=="") {
                ThongBao += " - Bạn cần phải nhập thông tin số điện thoại <br>";
            }
            if (account_email == null || account_email.length == 0 || account_email=="") {
                ThongBao += " - Bạn cần phải nhập thông tin email <br>";
            }
            if (account_address == null || account_address.length == 0 || account_address=="") {
                ThongBao += " - Bạn cần phải nhập thông tin địa chỉ <br>";
            }
            if (ThongBao == "") {
                $("#form_checkout").submit();
            }
            $("#txtThongBao").html(ThongBao);
        });
    });
</script>
<!--//content-->
@endsection