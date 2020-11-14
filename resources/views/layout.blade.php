<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
$account = Session::get('account');
if($account){
    $tax = $account->permission_rate; // dùng hàm thuế để làm giảm giá %
    $tax = (int) ($tax)*(-1);
    Cart::setGlobalTax($tax);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop thời trang </title>
    <link href="{{asset('public/frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('public/frontend/js/jquery.min.js')}}"></script>
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />  
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'><!--//fonts-->
    <!-- start menu -->
    <link href="{{asset('public/frontend/css/memenu.css')}}" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="{{asset('public/frontend/js/memenu.js')}}"></script>
    <script>$(document).ready(function(){$(".memenu").memenu();});</script>
    <script src="{{asset('public/frontend/js/simpleCart.min.js')}}"> </script>
</head>
<body>
    <!--header-->
    <div class="header">
        <div class="header-top">
            <div class="container">
                <div class="search">
                    <form action="{{URL::to('/show-filter-product/search')}}" method="POST">
                        {{csrf_field()}}
                        <input type="text" name="search_keywords" placeholder="Tìm kiếm sản phẩm">
                        <input type="submit" value="Tìm kiếm">
                    </form>
                </div>
                <div class="header-left">       
                    <ul>
                        @if($account)
                        <li style="color:white"><a href="{{URL::to('/account')}}">{{$account->permission_name}} : {{$account->account_account}}</a></li>
                        <p>
                            <span><a href="{{URL::to('/account')}}">Cài đặt </a></span>
                            <span>&nbsp;</span>
                            <span style="float:right;padding-right: 30px"><a href="{{URL::to('/logout')}}"> Đăng xuất</a></span>
                        </p>

                        @else
                        <li><a href="{{URL::to('/login')}}" >Đăng nhập</a></li>
                        @endif
                    </ul>
                    <div class="cart box_1">
                        <a href="{{URL::to('/show-cart')}}">
                            <h3> 
                                <div class="total">
                                    <span>
                                        <?php
                                        $list = Cart::Content();
                                        $tongtien=0;
                                        foreach($list as $item){
                                            $tongtien+=$item->price*$item->qty;
                                        }
                                        ?>
                                        {{number_format($tongtien).' VND'}} ( {{count($list)}} sản phẩm )
                                    </span>
                                </div>
                                <img src="{{URL::to('public/frontend/images/cart.png')}}" alt=""/>
                            </h3>
                        </a>
                        <p><a href="{{URL::to('/update-cart/rowId=deleteall&qty=deleteall')}}" class="simpleCart_empty">Empty Cart</a></p>

                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="container">
            <div class="head-top">
                <div class="logo">
                    <a href="{{URL::to('/trang-chu')}}" style="text-decoration: none;"><img src="{{URL::to('public/frontend/images/logo.png')}}" alt="" width="50px"><span style="color:red;font-size: 20px" > Shop Thời Trang</span></a> 
                </div>
                <div class=" h_menu4">
                    <ul class="memenu skyblue">
                      <li class="active grid"><a class="color8" href="{{URL::to('/trang-chu')}}">Trang chủ</a></li> 
                      <li class="grid"><a class="color1" href="#">Danh mục</a>
                        <div class="mepanel" style="width: 250px;margin-left:100px">
                            <div class="row">
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            @foreach($category as $key => $item)
                                            <li><a href="{{URL::to('/show-filter-product/category='.$item->category_id.'&brand=all')}}">{{$item->category_name}}</a></li>
                                            @endforeach
                                        </ul>  
                                    </div>                          
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="grid"><a class="color2" href="#">Thương hiệu</a>
                        <div class="mepanel" style="width: 250px;margin-left:250px">
                            <div class="row">
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            @foreach($brand as $key => $item)
                                            <li><a href="{{URL::to('/show-filter-product/category=all'.'&brand='.$item->brand_id)}}">{{$item->brand_name}}</a></li>
                                            @endforeach
                                        </ul>   
                                    </div>                          
                                </div>
                            </div>
                        </div>
                    </li>
                </ul> 
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>

</div>

@yield('content')

<div class="footer">
    <div class="container">
        <div class="footer-top-at">
            <div class="col-md-4 amet-sed">
                <h4>DANH MỤC SẢN PHẨM</h4>
                <ul class="nav-bottom">
                    @foreach($category as $key => $item)
                    <li><a href="{{URL::to('/show-filter-product/category='.$item->category_id.'&brand=all')}}">{{$item->category_name}}</a></li>
                    @endforeach
                </ul>   
            </div>
            <div class="col-md-4 amet-sed">
                <h4>THƯƠNG HIỆU SẢN PHẨM</h4>
                <ul class="nav-bottom">
                    @foreach($brand as $key => $item)
                    <li><a href="{{URL::to('/show-filter-product/category=all'.'&brand='.$item->brand_id)}}">{{$item->brand_name}}</a></li>
                    @endforeach
                </ul>   
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer-class">
        <p >© Nguyễn Quang Anh - Vũ Trung Kiên - Hồ Thu Phương</p>
    </div>
</div>
</body>
</html>
