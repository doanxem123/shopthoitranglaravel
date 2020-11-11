
<?php $__env->startSection('content'); ?>
<!-- slide -->
<div class="banner">
        <div class="container">
            <script src="<?php echo e(('public/frontend/js/responsiveslides.min.js')); ?>">

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
            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 grid-top">
                <a href="<?php echo e(URL::to('/show-filter-product/category='.$item->category_id.'&brand=all')); ?>" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo e(URL::to('public/frontend/images/menu/'.$item->category_image)); ?>" alt="" style="height: 357px;">
                            <div class="b-wrapper">
                                    <h3 class="b-animate b-from-left    b-delay03 ">
                                        <span><?php echo e($item->category_name); ?></span>
                                    </h3>
                                </div>
                </a>
            <p><a href="<?php echo e(URL::to('/show-filter-product/category='.$item->category_id.'&brand=all')); ?>"><?php echo e($item->category_name); ?></a></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="clearfix"> </div>
        <br>
        <h1>Thương hiệu sản phẩm</h1>
        <div class="grid-in">
            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 grid-top">
                <a href="<?php echo e(URL::to('/show-filter-product/category=all'.'&brand='.$item->brand_id)); ?>" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo e(URL::to('public/frontend/images/menu/'.$item->brand_image)); ?>" alt="" style="height: 357px;">
                            <div class="b-wrapper">
                                    <h3 class="b-animate b-from-left    b-delay03 ">
                                        <span><?php echo e($item->brand_name); ?></span>
                                    </h3>
                                </div>
                </a>
            <p><a href="<?php echo e(URL::to('/show-filter-product/category=all'.'&brand='.$item->brand_id)); ?>"><?php echo e($item->brand_name); ?></a></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="clearfix"> </div>
    </div>
    <!----->
    
    
    </div>
    <!---->
    <div class="content-bottom">
        <ul>
            <li><img class="img-responsive" src="<?php echo e(('public/frontend/images/lo.png')); ?>" alt=""></li>
            <li><img class="img-responsive" src="<?php echo e(('public/frontend/images/lo1.png')); ?>" alt=""></li>
            <li><img class="img-responsive" src="<?php echo e(('public/frontend/images/lo2.png')); ?>" alt=""></li>
            <li><img class="img-responsive" src="<?php echo e(('public/frontend/images/lo3.png')); ?>" alt=""></li>
            <li><img class="img-responsive" src="<?php echo e(('public/frontend/images/lo4.png')); ?>" alt=""></li>
            <li><img class="img-responsive" src="<?php echo e(('public/frontend/images/lo5.png')); ?>" alt=""></li>
        <div class="clearfix"> </div>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shopthoitranglaravel\resources\views/pages/home.blade.php ENDPATH**/ ?>