<?php
echo link_tag(css_url()."bootstrap.css");
echo link_tag(css_url()."bootstrap-datepicker.css");
echo link_tag(css_url()."toastr.css");
?>
<html>
	<head>
		<script src="<?=js_url().'jquery-3.1.1.min.js'?>"></script>
		<script src="<?=js_url().'bootstrap.js'?>"></script>
		<script src="<?=js_url().'bootstrap-datepicker.min.js'?>"></script>
		<script src="<?=js_url().'toastr.min.js'?>"></script>
	</head>
	<body>	
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Logo</a>
				</div>
				
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Products <span class="sr-only"></span></a></li>
						<li><a href="#">Orders</a></li>
						<li><a href="#">Downloads</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Support<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">FAQ</a></li>
								<li><a href="#">Submit a ticket</a></li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if($this->auth->isClientLoggedIn()){?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$this->session->userdata('c_first_name');?><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="profile_settings">Profile Settings</a></li>
									<li><a href="account_settings">Account Settings</a></li>
									<li><a href="pchange">Change Password</a></li>
									<li><a href="auth/logout/client">Logout</a></li>
								</ul>
							</li>
						<?php } else {?>
							<form class="navbar-form navbar-left" method="POST" action="auth/login" autocomplete="off">
								<div class="form-group has-feedback">
									<input type="text" name="username" class="form-control" placeholder="Username" required>
									<i class="glyphicon glyphicon-user form-control-feedback"></i>
								</div>
								<div class="form-group has-feedback">
									<input type="password" name="password" class="form-control" placeholder="Password" required>
									<i class="glyphicon glyphicon-lock form-control-feedback"></i>
								</div>
								<input type="submit" class="btn btn-success" value="Login"> |
								<a href="auth/register" class="btn btn-primary">Register</a> |
								<a href="forgotpassword" class="btn btn-primary">Forgot password?</a>
							</form>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>

		<?=$content;?>
		
		<footer class="footer">
		    <div class="container align-center">
				<p class="text-muted"><i>Copyright &#169; 2017. All Rights Reserved.<br>Company name, company address</i>
				</p>
			</div>
		</footer>
	</body>
	<script>
		$(function(){
			<?=$this->session->flashdata("success_message") != null ? 'toastr.success("' . $this->session->flashdata("success_message") . '");' : null?>
			<?=$this->session->flashdata("error_message") != null ? 'toastr.error("' . $this->session->flashdata("error_message") . '");' : null?>

			$("input[type=submit]").click(function(){
				$("#loadingSVG").show();
			});
		});
	</script>
</html>
