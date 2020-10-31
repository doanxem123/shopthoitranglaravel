@extends('layout')
@section('content')
<!-- slide -->
<div class="banner">
        <div class="container">
            <script src="{{('public/frontend/js/responsiveslides.min.js')}}">

            </script>
            <script>
                $(function () {
                  $("#slider").responsiveSlides({
                    auto: true,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    pager: true,
                });
              });
            </script>

            <div id="top" class="callbacks_container">
                <ul class="rslides" id="slider">
                <li>

                    <div class="banner-text">
                        <h3>Lorem Ipsum is not simply dummy  </h3>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor .</p>
                        <a href="single.html">Learn More</a>
                    </div>

                </li>
                <li>

                    <div class="banner-text">
                        <h3>There are many variations </h3>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor .</p>
                        <a href="single.html">Learn More</a>

                    </div>

                </li>
                <li>
                    <div class="banner-text">
                        <h3>Sed ut perspiciatis unde omnis</h3>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor .</p>
                        <a href="single.html">Learn More</a>
                    </div>
                </li>
                </ul>
            </div>
        </div>
    </div>
<!--content-->
<div class="content">
    <div class="container">
    <div class="content-top">
        <h1>Danh mục sản phẩm</h1>
        <div class="grid-in">
            @foreach($category as $key => $item)
            <div class="col-md-4 grid-top">
                <a href="{{URL::to('/show-filter-product/category='.$item->category_id.'&brand=all')}}" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="{{URL::to('public/frontend/images/menu/'.$item->category_image)}}" alt="" style="height: 357px;">
                            <div class="b-wrapper">
                                    <h3 class="b-animate b-from-left    b-delay03 ">
                                        <span>{{$item->category_name}}</span>
                                    </h3>
                                </div>
                </a>
            <p><a href="{{URL::to('/show-filter-product/category='.$item->category_id.'&brand=all')}}">{{$item->category_name}}</a></p>
            </div>
            @endforeach
        </div>
        <div class="clearfix"> </div>
        <br>
        <h1>Thương hiệu sản phẩm</h1>
        <div class="grid-in">
            @foreach($brand as $key => $item)
            <div class="col-md-4 grid-top">
                <a href="{{URL::to('/show-filter-product/category=all'.'&brand='.$item->brand_id)}}" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="{{URL::to('public/frontend/images/menu/'.$item->brand_image)}}" alt="" style="height: 357px;">
                            <div class="b-wrapper">
                                    <h3 class="b-animate b-from-left    b-delay03 ">
                                        <span>{{$item->brand_name}}</span>
                                    </h3>
                                </div>
                </a>
            <p><a href="{{URL::to('/show-filter-product/category=all'.'&brand='.$item->brand_id)}}">{{$item->brand_name}}</a></p>
            </div>
            @endforeach
        </div>
        <div class="clearfix"> </div>
    </div>
    <!----->
    
    <div class="content-top-bottom">
        <h2>Featured Collections</h2>
        <div class="col-md-6 men">
            <a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="{{('public/frontend/images/t1.jpg')}}" alt="">
                <div class="b-wrapper">
                                    <h3 class="b-animate b-from-top top-in   b-delay03 ">
                                        <span>Lorem</span>  
                                    </h3>
                                </div>
            </a>
            
            
        </div>
        <div class="col-md-6">
            <div class="col-md1 ">
                <a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="{{('public/frontend/images/t2.jpg')}}" alt="">
                    <div class="b-wrapper">
                                    <h3 class="b-animate b-from-top top-in1   b-delay03 ">
                                        <span>Lorem</span>  
                                    </h3>
                                </div>
                </a>
                
            </div>
            <div class="col-md2">
                <div class="col-md-6 men1">
                    <a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="{{('public/frontend/images/t3.jpg')}}" alt="">
                            <div class="b-wrapper">
                                    <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                                        <span>Lorem</span>  
                                    </h3>
                                </div>
                    </a>
                    
                </div>
                <div class="col-md-6 men2">
                    <a href="single.html" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="{{('public/frontend/images/t4.jpg')}}" alt="">
                            <div class="b-wrapper">
                                    <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                                        <span>Lorem</span>  
                                    </h3>
                                </div>
                    </a>
                    
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    </div>
    <!---->
    <div class="content-bottom">
        <ul>
            <li><a href="#"><img class="img-responsive" src="{{('public/frontend/images/lo.png')}}" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="{{('public/frontend/images/lo1.png')}}" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="{{('public/frontend/images/lo2.png')}}" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="{{('public/frontend/images/lo3.png')}}" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="{{('public/frontend/images/lo4.png')}}" alt=""></a></li>
            <li><a href="#"><img class="img-responsive" src="{{('public/frontend/images/lo5.png')}}g" alt=""></a></li>
        <div class="clearfix"> </div>
        </ul>
    </div>
</div>
@endsection