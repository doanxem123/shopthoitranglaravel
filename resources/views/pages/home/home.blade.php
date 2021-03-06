@extends('layout')
@section('content')
<!-- slide -->
<div class="banner">
    <div class="container">
        <script src="{{asset('public/frontend/js/responsiveslides.min.js')}}">
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
                <img src="{{URL::to('public/frontend/images/slide/banner2.jpg')}} " style="height:560px;max-height: 560px">
            </li>
            <li>
                <img src="{{URL::to('public/frontend/images/slide/chanel.jpg')}}" style="height:560px;max-height: 560px">
            </li>
            <li>
                <img src="{{URL::to('public/frontend/images/slide/hermes.jpg')}}" style="height:560px;max-height: 560px">
            </li>
            <li>
                <img src="{{URL::to('public/frontend/images/slide/prada.jpg')}}" style="height:560px;max-height: 560px">
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
                    <a href="{{URL::to('/show-filter-product/category='.$item->category_id.'&brand=all')}}" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="{{URL::to('public/frontend/images/category/'.$item->category_image)}}" alt="" style="height: 357px;">
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
                    <a href="{{URL::to('/show-filter-product/category=all'.'&brand='.$item->brand_id)}}" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="{{URL::to('public/frontend/images/brand/'.$item->brand_image)}}" alt="" style="height: 357px;">
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


    </div>
    <!---->
    <div class="content-bottom">
    </div>
</div>
@endsection