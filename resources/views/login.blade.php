<?php
$data=Session::get('data');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Trang quản lý </title>

	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{asset('public/backend/font-awesome/4.5.0/css/font-awesome.min.css')}}" />

	<!-- text fonts -->
	<link rel="stylesheet" href="{{asset('public/backend/css/fonts.googleapis.com.css')}}" />

	<!-- ace styles -->
	<link rel="stylesheet" href="{{asset('public/backend/css/ace.min.css')}}">
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{asset('public/backend/css/ace-part2.min.css')}}" />
		<![endif]-->
		<link rel="stylesheet" href="{{asset('public/backend/css/ace-rtl.min.css')}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="asset/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="asset/js/html5shiv.min.js"></script>
		<script src="asset/js/respond.min.js"></script>
	<![endif]-->

</head>

<body class="login-layout">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<h1>
								<a href="{{URL::to('/trang-chu')}}" style="text-decoration-line: none">
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red">Shop</span>
									<span class="white" id="id-text2">Thời trang</span>
								</a>
							</h1>
							<h4 class="blue" id="id-company-text">&copy; NQA - Kiên - Hương</h4>
						</div>

						<div class="space-6"></div>

						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header blue lighter bigger">
											<i class="ace-icon fa fa-coffee green"></i>
											Đăng nhập
										</h4>

										<div class="space-6"></div>
										<p> Mời đăng nhập tài khoản</p>
										<form action="{{ URL::to('/check-login') }}" method="POST">
											{{ csrf_field() }}
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" name="account_account" class="form-control" placeholder="Tài khoản" />
														<i class="ace-icon fa fa-user"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" name="account_password" class="form-control" placeholder="Mật khẩu" />
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>

												<?php
												$message = Session::get('message');
												if($message){
													echo '<div class="alert alert-warning red">',$message,'</div>';
													Session::put('message',null);
												}
												?>

												<div class="clearfix">

													<button type="submit" class="width-40 pull-right btn btn-sm btn-primary">
														<i class="ace-icon fa fa-key"></i>
														<span class="bigger-110">Đăng nhập</span>
													</button>
												</div>

												<div class="space-4"></div>
											</fieldset>
										</form>
									</div><!-- /.widget-main -->

									<div class="toolbar clearfix">
										<div></div>	
										<div>
											<a href="#" data-target="#signup-box" class="user-signup-link">
												Đăng ký
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div>
								</div><!-- /.widget-body -->
							</div><!-- /.login-box -->

							<div id="signup-box" class="signup-box widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header green lighter bigger">
											<i class="ace-icon fa fa-users blue"></i>
											Đăng ký
										</h4>

										<div class="space-6"></div>
										<p> Mời nhập thông tin đăng ký</p>

										<form id="form_signup" action="{{ URL::to('/sign-up') }}" method="POST">
											{{ csrf_field() }}
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" id="account_account_signup" name="account_account_signup" class="form-control" placeholder="Tên tài khoản" />
														<i class="ace-icon fa fa-user"></i>
													</span>
												</label>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" id="account_password_signup" name="account_password_signup" class="form-control" placeholder="Mật khẩu" />
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" id="account_password_signup_repeat" name="account_password_signup_repeat" class="form-control" placeholder="Nhập lại mật khẩu" />
														<i class="ace-icon fa fa-retweet"></i>
													</span>
												</label>
													{{-- <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Họ và tên" />
															<i class="ace-icon fa fa-pencil-square-o"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Số điện thoại" />
															<i class="ace-icon fa fa-phone"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label> --}}

													{{-- <label class="block">
														<input type="checkbox" class="ace" />
														<span class="lbl">
															Chấp nhận
															<a href="#">Thỏa thuận</a>
														</span>
													</label> --}}

													<div class="space-24"></div>
													<div class="alert alert-warning red" id="txtThongBao">
													</div>
													<div class="clearfix">
														{{-- <button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">khởi tạo lại</span>
														</button> --}}

														<button type="button" id="signup-submit" class="width-40 pull-right btn btn-sm btn-success">
															<span class="bigger-110">Đăng ký</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Về đăng nhập
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->

							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{asset('public/backend/js/jquery-2.1.4.min.js')}}"></script>

		<!-- <![endif]-->

')}}		<!--[if IE]>
<script src="asset/js/jquery-1.11.3.min.js"></script>
<![endif]-->

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		$(document).on('click', '.toolbar a[data-target]', function(e) {
			e.preventDefault();
			var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			});
	});



			//you don't need this, just used for changing background
			jQuery(function($) {
				$('#btn-login-dark').on('click', function(e) {
					$('body').attr('class', 'login-layout');
					$('#id-text2').attr('class', 'white');
					$('#id-company-text').attr('class', 'blue');

					e.preventDefault();
				});
				$('#btn-login-light').on('click', function(e) {
					$('body').attr('class', 'login-layout light-login');
					$('#id-text2').attr('class', 'grey');
					$('#id-company-text').attr('class', 'blue');

					e.preventDefault();
				});
				$('#btn-login-blur').on('click', function(e) {
					$('body').attr('class', 'login-layout blur-login');
					$('#id-text2').attr('class', 'white');
					$('#id-company-text').attr('class', 'light-blue');

					e.preventDefault();
				});

			});
		</script>
		<script type="text/javascript">
			$(document).ready(function () {
            //Xử lý thêm mới
            $('#signup-submit').click(function () {
                //Lấy thông tin
                var taiKhoan = $("#account_account_signup").val();
                var matKhau = $("#account_password_signup").val();
                var matKhauNhapLai = $("#account_password_signup_repeat").val();
                var ThongBao = "";

                if (taiKhoan == null || taiKhoan.length == 0) {
                	ThongBao += " - Bạn cần phải nhập thông tin tài khoản <br>";
                }
                if (matKhau == null || matKhau.length == 0) {
                	ThongBao += " - Bạn cần phải nhập thông tin mật khẩu <br>";
                }
                if (matKhauNhapLai != matKhau) {
                	ThongBao += " - Mật khẩu nhập lại không trùng với mật khẩu đã nhập<br>";
                }
                var check = false; //duplicate
                @foreach($data as $item)
                if(taiKhoan == '{{$item->account_account}}'){
                	check = true;
                }
                @endforeach
                if(check == true){
                	ThongBao += " - Tài khoản đã tồn tại";
                }

                if (ThongBao == "") {
                	$("#form_signup").submit();
                }
                $("#txtThongBao").html(ThongBao);
            });
        });
    </script>
</body>
</html>
