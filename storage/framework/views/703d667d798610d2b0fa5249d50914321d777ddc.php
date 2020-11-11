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
    <link href="<?php echo e(asset('public/frontend/css/bootstrap.css')); ?>" rel="stylesheet" type="text/css" media="all" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo e(asset('public/frontend/js/jquery.min.js')); ?>"></script>
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="<?php echo e(asset('public/frontend/css/style.css')); ?>" rel="stylesheet" type="text/css" media="all" />  
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'><!--//fonts-->
    <!-- start menu -->
    <link href="<?php echo e(asset('public/frontend/css/memenu.css')); ?>" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="<?php echo e(asset('public/frontend/js/memenu.js')); ?>"></script>
    <script>$(document).ready(function(){$(".memenu").memenu();});</script>
    <script src="<?php echo e(asset('public/frontend/js/simpleCart.min.js')); ?>"> </script>
</head>
<body>
    <!--header-->
    <div class="header">
        <div class="header-top">
            <div class="container">
                <div class="search">
                    <form action="<?php echo e(URL::to('/show-filter-product/search')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="text" name="search_keywords" placeholder="Tìm kiếm sản phẩm">
                        <input type="submit" value="Tìm kiếm">
                    </form>
                </div>
                <div class="header-left">       
                    <ul>
                        <li ><a href="login.html"  >Đăng nhập</a></li>
                        <li><a  href="register.html"  >Đăng ký</a></li>

                    </ul>
                    <div class="cart box_1">
                        <a href="<?php echo e(URL::to('/show-cart')); ?>">
                            <h3> 
                            <div class="total">
                            <span>
                                <?php
                                    $list = Cart::Content();
                                    $tongtien=0;
                                    $dem=0;
                                    foreach($list as $item){
                                        $tongtien+=$item->price*$item->qty;
                                        //$dem++;
                                    }
                                    $dem=count($list);
                                ?>
                                <?php echo e(number_format($tongtien).' VND'); ?> ( <?php echo e(count($list)); ?> sản phẩm )
                            </span>
                            </div>
                            <img src="<?php echo e(URL::to('public/frontend/images/cart.png')); ?>" alt=""/>
                            </h3>
                        </a>
                        <p><a href="<?php echo e(URL::to('/update-cart/rowId=all&qty=all')); ?>" class="simpleCart_empty">Empty Cart</a></p>

                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="container">
            <div class="head-top">

                <div class=" h_menu4">
                    <ul class="memenu skyblue">
                      <li class="active grid"><a class="color8" href="<?php echo e(URL::to('/trang-chu')); ?>">Trang chủ</a></li> 
                      <li class="grid"><a class="color1" href="#">Danh mục</a>
                        <div class="mepanel" style="width: 250px;margin-left:100px">
                            <div class="row">
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(URL::to('/show-filter-product/category='.$item->category_id.'&brand=all')); ?>"><?php echo e($item->category_name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(URL::to('/show-filter-product/category=all'.'&brand='.$item->brand_id)); ?>"><?php echo e($item->brand_name); ?></a></li>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->yieldContent('content'); ?>

<div class="footer">
    <div class="container">
        <div class="footer-top-at">
            <!-- Map -->
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer-class">
        <p >© Nguyễn Quang Anh - Vũ Trung Kiên</a> </p>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\shopthoitranglaravel\resources\views/layout.blade.php ENDPATH**/ ?>