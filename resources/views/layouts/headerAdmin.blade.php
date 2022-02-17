	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
		<div class="navbar-wrapper ">
			<div class="navbar-brand header-logo">
				<a href="{{route('gadmin')}}" class="b-brand">
					<img src="{{asset('admin/images/logo.svg')}}" alt="" class="logo images">
					<img src="{{asset('admin/images/logo-icon.svg')}}" alt="" class="logo-thumb images">
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="{{route('guser')}}"><span></span></a>
			</div>
			<div class="navbar-content scroll-div">
				<ul class="nav pcoded-inner-navbar">
					<li class="nav-item">
						<a href="{{route('guser')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Quản lý tài khoản</span></a>
					</li>
					<li class="nav-item">
						<a href="{{route('gProductAdmin')}}" class="nav-link"><span class="pcoded-micon"></span><span class="pcoded-mtext">Quản lý sản phẩm</span></a>
					</li>
					<li class="nav-item">
						<a href="{{route('gOrderAdmin')}}" class="nav-link"><span class="pcoded-micon"></span><span class="pcoded-mtext">Quản lý đơn hàng</span></a>
					</li>
					<li class="nav-item">
						<a href="{{route('gCategoriesAdmin')}}" class="nav-link"><span class="pcoded-micon"></span><span class="pcoded-mtext">Quản lý danh mục</span></a>
					</li>
					<li class="nav-item">
						<a href="{{route('gCommentAdmin')}}" class="nav-link"><span class="pcoded-micon"></span><span class="pcoded-mtext">Quản lý bình luận</span></a>
					</li>			
				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
			<a href="index.html" class="b-brand">
				<img src="{{asset('admin/images/logo.svg')}}" alt="" class="logo images">
				<img src="{{asset('admin/images/logo-icon.svg')}}" alt="" class="logo-thumb images">
			</a>
		</div>
		<a class="mobile-menu" id="mobile-header" href="#!">
			<i class="feather icon-more-horizontal"></i>
		</a>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto">
				<li>
					<font style="font-weight: bolder;">{{ session('adname') }}</font>
				</li>
				<li>
					<a href="{{route('gadlogout')}}" class="dud-logout" title="Logout">
						<i class="feather icon-log-out"></i>
					</a>
				</li>
			</ul>
		</div>
	</header>
	<!-- [ Header ] end -->

	<!-- [ Main Content ] start -->
	<div class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="main-body">
						<div class="page-wrapper">
							<!-- [ breadcrumb ] start -->
							<div class="page-header">
								<div class="page-block">
									<div class="row align-items-center">
										<div class="col-md-12">
											<div class="page-header-title">
												<h5>Home</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="{{route('guser')}}"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="{{route('guser')}}">Analytics Dashboard</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- [ breadcrumb ] end -->
							<!-- [ Main Content ] start -->
							<div class="row">

								<!-- product profit start -->
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-red">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Tổng số lượng sản phẩm</h6>
													<h3 class="m-b-0 text-white">{{$product->count()}}</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-money-bill-alt text-c-red f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white"><span class="label label-danger m-r-10">+11%</span>From Previous Month</p>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-blue">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Số lượng đơn hàng khách hàng đã đặt</h6>
													<h3 class="m-b-0 text-white">{{$order->count()}}</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-database text-c-blue f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white"><span class="label label-primary m-r-10">+12%</span>From Previous Month</p>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-green">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Tổng số tiền đã thu được</h6>
													<h3 class="m-b-0 text-white">{{number_format($orderdetail->sum("product_price"),0)}}</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-dollar-sign text-c-green f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white"><span class="label label-success m-r-10">+52%</span>From Previous Month</p>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-yellow">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Số lượng sản phẩm trong kho</h6>
													<h3 class="m-b-0 text-white">{{$product->sum("products_qty")}}</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-tags text-c-yellow f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white"><span class="label label-warning m-r-10">+52%</span>From Previous Month</p>
										</div>
									</div>
								</div>
								<!-- product profit end 
								<div class="col-md-12 col-xl-4">
									<div class="card card-social">
										<div class="card-block border-bottom">
											<div class="row align-items-center justify-content-center">
												<div class="col-auto">
													<i class="fab fa-facebook-f text-primary f-36"></i>
												</div>
												<div class="col text-right">
													<h3>12,281</h3>
													<h5 class="text-c-blue mb-0">+7.2% <span class="text-muted">Total Likes</span></h5>
												</div>
											</div>
										</div>
										<div class="card-block">
											<div class="row align-items-center justify-content-center card-active">
												<div class="col-6">
													<h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>35,098</h6>
													<div class="progress">
														<div class="progress-bar progress-c-blue" role="progressbar" style="width:60%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
												<div class="col-6">
													<h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>350</h6>
													<div class="progress">
														<div class="progress-bar progress-c-green" role="progressbar" style="width:45%;height:6px;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-xl-4">
									<div class="card card-social">
										<div class="card-block border-bottom">
											<div class="row align-items-center justify-content-center">
												<div class="col-auto">
													<i class="fab fa-twitter text-c-info f-36"></i>
												</div>
												<div class="col text-right">
													<h3>11,200</h3>
													<h5 class="text-c-info mb-0">+6.2% <span class="text-muted">Total Likes</span></h5>
												</div>
											</div>
										</div>
										<div class="card-block">
											<div class="row align-items-center justify-content-center card-active">
												<div class="col-6">
													<h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>34,185</h6>
													<div class="progress">
														<div class="progress-bar progress-c-blue" role="progressbar" style="width:40%;height:6px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
												<div class="col-6">
													<h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>800</h6>
													<div class="progress">
														<div class="progress-bar progress-c-green" role="progressbar" style="width:70%;height:6px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-xl-4">
									<div class="card card-social">
										<div class="card-block border-bottom">
											<div class="row align-items-center justify-content-center">
												<div class="col-auto">
													<i class="fab fa-google-plus-g text-c-red f-36"></i>
												</div>
												<div class="col text-right">
													<h3>10,500</h3>
													<h5 class="text-c-red mb-0">+5.9% <span class="text-muted">Total Likes</span></h5>
												</div>
											</div>
										</div>
										<div class="card-block">
											<div class="row align-items-center justify-content-center card-active">
												<div class="col-6">
													<h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>25,998</h6>
													<div class="progress">
														<div class="progress-bar progress-c-blue" role="progressbar" style="width:80%;height:6px;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
												<div class="col-6">
													<h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>900</h6>
													<div class="progress">
														<div class="progress-bar progress-c-green" role="progressbar" style="width:50%;height:6px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div> -->