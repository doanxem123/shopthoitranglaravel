<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
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
    <script src="{{asset('js/simpleCart.min.js')}}"> </script>
</head>
<body>
    <!--header-->
    <div class="header">
        <div class="header-top">
            <div class="container">
                <div class="search">
                    <form>
                        <input type="text" value="Search " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
                        <input type="submit" value="Go">
                    </form>
                </div>
                <div class="header-left">       
                    <ul>
                        <li ><a href="login.html"  >Đăng nhập</a></li>
                        <li><a  href="register.html"  >Đăng ký</a></li>

                    </ul>
                    <div class="cart box_1">
                        <a href="checkout.html">
                            <h3> <div class="total">
                                <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
                                <img src="{{('public/frontend/images/cart.png')}}" alt=""/></h3>
                            </a>
                            <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>

                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="container">
                <div class="head-top">
                    <div class="logo">
                        <a href="index.html"><img src="{{('public/frontend/images/logo.png')}}" alt=""></a> 
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
                        <li><a class="color4" href="blog.html">Blog</a></li>                
                        <li><a class="color6" href="contact.html">Contact</a></li>
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
                <h4>MORE INFO</h4>
                <ul class="nav-bottom">
                    <li><a href="#">How to order</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="contact.html">Location</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Membership</a></li> 
                </ul>   
            </div>
            <div class="col-md-4 amet-sed ">
                <h4>CONTACT US</h4>
                
                <p>
                Contrary to popular belief</p>
                <p>The standard chunk</p>
                <p>office:  +12 34 995 0792</p>
                <ul class="social">
                    <li><a href="#"><i> </i></a></li>                       
                    <li><a href="#"><i class="twitter"> </i></a></li>
                    <li><a href="#"><i class="rss"> </i></a></li>
                    <li><a href="#"><i class="gmail"> </i></a></li>

                </ul>
            </div>
            <div class="col-md-4 amet-sed">
                <h4>Newsletter</h4>
                <p>Sign Up to get all news update
                and promo</p>
                <form>
                    <input type="text" value="" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}">
                    <input type="submit" value="Sign up">
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer-class">
        <p >© Nguyễn Quang Anh - Vũ Trung Kiên</a> </p>
    </div>
</div>
</body>
</html>
