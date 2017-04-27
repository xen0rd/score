<?php
echo link_tag(css_url()."bootstrap.css");
echo link_tag(css_url()."bootstrap-datepicker.css");
echo link_tag(css_url()."AdminLTE.css");
echo link_tag(css_url()."skins/_all-skins.css");
echo link_tag(css_url()."toastr.css");
echo link_tag(css_url()."font-awesome.min.css");
echo link_tag(css_url()."ionicons.min.css");
?>
<html>
	<head>
		<title><?=title()?></title>
		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="<?=js_url().'jquery-3.1.1.min.js'?>"></script>
		<script src="<?=js_url().'bootstrap.js'?>"></script>
		<script src="<?=js_url().'bootstrap-datepicker.min.js'?>"></script>
		<script src="<?=js_url().'app.min.js'?>"></script>
		<script src="<?=js_url().'toastr.min.js'?>"></script>
		<script src="<?=js_url().'chart.js'?>"></script>
	</head>

	<body class="hold-transition sidebar-mini <?=$userInfo->theme_name?>">
		<div class="wrapper">
			<header class="main-header">
				<a href="<?=base_url()?>admin" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini">LOGO</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg">BRAND NAME</span>
				</a>
				
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- Messages Menu -->
							<li class="dropdown messages-menu">
								<!-- Menu toggle button -->
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-envelope-o"></i>
									<span class="label label-success">20</span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">You have 4 messages</li>
									<li>
										<!-- inner menu: contains the messages -->
										<ul class="menu">
											<li><!-- start message -->
												<a href="#">
													<div class="pull-left">
														<!-- User Image -->
														<img src="<?=images_url()?>avatar.jpg" class="img-circle" alt="User Image">
													</div>
													<!-- Message title and timestamp -->
													<h4>
														Support Team
														<small><i class="fa fa-clock-o"></i> 5 mins</small>
													</h4>
													<!-- The message -->
													<p>Why not buy a new awesome theme?</p>
												</a>
											</li>
											<!-- end message -->
										</ul>
										<!-- /.menu -->
									</li>
									<li class="footer">
										<a href="#">See All Messages</a>
									</li>
								</ul>
							</li>
							
							<!-- Notifications Menu -->
							<li class="dropdown notifications-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-bell-o"></i>
									<span class="label label-warning">10</span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">You have 10 notifications</li>
									<li>
										<!-- Inner Menu: contains the notifications -->
										<ul class="menu">
											<li>
												<a href="#">
													<i class="fa fa-users text-aqua"></i> 5 new members joined today
												</a>
											</li>
										</ul>
									</li>
									<li class="footer">
										<a href="#">View all</a>
									</li>
								</ul>
							</li>
							
							<li class="dropdown tasks-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-flag-o"></i>
									<span class="label label-danger">9</span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">You have 9 tasks</li>
									<li>
									<ul class="menu">
										<li>
											<a href="#">
												<h3>
													Design some buttons
													<small class="pull-right">20%</small>
												</h3>
												<div class="progress xs">
													<!-- Change the css width attribute to simulate progress -->
													<div class="progress-bar progress-bar-aqua" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
														<span class="sr-only">80% Complete</span>
													</div>
												</div>
											</a>
										</li>
									</ul>
									</li>
									<li class="footer">
									<a href="#">View all tasks</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="<?=base_url()?>auth/logout" class=""><i class="fa fa-sign-out"></i> Sign out</a>
							</li>
							
							<!-- <li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="_assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
									
									<span class="hidden-xs"><?=ucfirst($this->session->userdata('u_first_name')) . " " . ucfirst($this->session->userdata('u_last_name'));?></span>
								</a>
								<ul class="dropdown-menu">
									<li class="user-header">
										<img src="_assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
										<p>
											<?=ucfirst($this->session->userdata('u_first_name')) . " " . ucfirst($this->session->userdata('u_last_name')) ;?>
											<small><i><?=strtoupper($this->session->userdata('u_role'));?></i></small>
										</p>
									</li>
									<li class="user-footer">
										<div class="pull-right">
											<a href="auth/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
										</div>
									</li>
								</ul>
							</li>-->
						</ul>
					</div>
				</nav>
			</header>
			
			<!-- Sidebar -->
			<?=$sidebar?>
			
			<div class="content-wrapper">
				<!-- Content Header -->
				<section class="content-header">
					<h1>
					<?=$menu['description']?>
					<small><?=isset($subMenu['description']) ? "> " . $subMenu['description'] : ''?></small>
					</h1>
				</section>
				
				<!-- Main content -->
				<section class="content">
					<?=$content;?>
				</section>
			</div>
			
			<!-- Footer -->
			<footer class="main-footer">
				<strong>Copyright &copy; 2017 <a href="#">Company</a>.</strong> All rights reserved.
				<div class="pull-right hidden-xs">
					<!-- Anything you want -->
				</div>
			</footer>
		</div>
		
		<!-- Loading SVG -->
		<img id="loadingSVG" src='<?=images_url()?>loading.svg' style='width:100px; position:absolute; top:50%; left:50%; z-index:9999; transform: translate(-50%, -50%); display:none;'>
	</body>
	
	<script>
		$(function(){
			<?=$this->session->flashdata("success_message") != null ? 'toastr.success("' . $this->session->flashdata("success_message") . '");' : null?>
			<?=$this->session->flashdata("error_message") != null ? 'toastr.error("' . $this->session->flashdata("error_message") . '");' : null?>

			$("input[type=submit]").click(function(){
				$("body div").css({"-webkit-filter" : "grayscale(15%)",
							"-moz-filter" : "grayscale(15%)",
							"-o-filter" : "grayscale(15%)",
			    			"-ms-filter" : "grayscale(15%)",
			    			"filter" : "grayscale(15%)"});
				
				$("#loadingSVG").show();
			});
		});
	</script>
	
</html>	