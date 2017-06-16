<?php
echo link_tag(css_url(). "bootstrap.css");
echo link_tag(css_url(). "font-awesome.min.css");
echo link_tag(css_url(). "toastr.css");
?>
<html>
	<head>
		<script src="<?=js_url()?>jquery-3.1.1.min.js"></script>
		<script src="<?=js_url()?>bootstrap.js"></script>
		<script src="<?=js_url()?>toastr.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row form-group">
				<div class="col-xs-8 col-xs-offset-2">
					<ul class="nav nav-pills nav-justified thumbnail setup-panel">
						<li class="active"><a href="#step-1">
							<h4 class="list-group-item-heading">Step 1</h4>
							<p class="list-group-item-text">System Check</p>
							</a>
						</li>
						<li class="disabled">
							<a href="#step-2">
								<h4 class="list-group-item-heading">Step 2</h4>
								<p class="list-group-item-text">License</p>
							</a>
						</li>
						<li class="disabled">
							<a href="#step-3">
								<h4 class="list-group-item-heading">Step 3</h4>
								<p class="list-group-item-text">Database setup</p>
							</a>
						</li>
						<li class="disabled">
							<a href="#step-4">
								<h4 class="list-group-item-heading">Step 4</h4>
								<p class="list-group-item-text">Basic Settings</p>
							</a>
						</li>    
					</ul>
				</div>
			</div>
		</div>	
	
		<div class="container">
			<div class="row setup-content" id="step-1">
				<div class="col-xs-8 col-xs-offset-2">
					<div class="col-md-12 well text-center">
						<?php if(array_search("php7",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> PHP version 7 or above is required</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> PHP version 7</span></i>
							</div>
						<?php } ?>
						<?php if(array_search("mod_php7",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> Mod_php7 apache module missing</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> Mod_php7 apache module loaded</span></i>
							</div>
						<?php } ?>
						<?php if(array_search("mysqli",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> MySQLi PHP extension missing</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> MySQLi PHP extension loaded</span></i>
							</div>
						<?php } ?>
						<?php if(array_search("mcrypt",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> Mcrypt PHP extension missing</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> Mcrypt PHP extension loaded</span></i>
							</div>
						<?php } ?>
						<?php if(array_search("mbstring",$checked) === FALSE){?>
						<div class="alert alert-danger">
							<i class="fa fa-close"><span> MBString PHP extension missing</span></i>
						</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> MBString PHP extension loaded</span></i>
							</div>
						<?php } ?>
						<?php if(array_search("gd",$checked) === FALSE){?>
						<div class="alert alert-danger">
							<i class="fa fa-close"><span> GD PHP extension missing</span></i>
						</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> GD PHP extension loaded</span></i>
							</div>
						<?php } ?>
						<?php if(array_search("PDO",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> PDO PHP extension missing</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> PDO PHP extension loaded</span></i>
							</div>
						<?php } ?>
						<?php if(array_search("dom",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> DOM PHP extension missing</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> DOM PHP extension loaded</span></i>
							</div>
						<?php } ?>
						<?php if(array_search("curl",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> CURL PHP extension missing</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> CURL PHP extension loaded</span></i>
							</div>
						<?php } ?>
						<?php if(array_search("database",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> Permission to write to Database File (application/config/database.php) is denied</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success" id="database">
							<i class="fa fa-check"><span> Database file is writable</span></i>
						</div>
						<?php } ?>
						<?php if(array_search("config",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> Permission to write to Config File (application/config/config.php) is denied</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success" id="database">
							<i class="fa fa-check"><span> Config file is writable</span></i>
						</div>
						<?php } ?>
						<?php if(array_search("routes",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> Permission to write to Routes File (application/config/routes.php) is denied</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
							<i class="fa fa-check"><span> Routes file is writable</span></i>
						</div>
						<?php } ?>
						<?php if(array_search("autoload",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> Permission to write to Autoload File (application/config/autoload.php) is denied</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
							<i class="fa fa-check"><span> Autoload file is writable</span></i>
						</div>
						<?php } ?>
						<?php if(array_search("htaccess",$checked) === FALSE){?>
							<div class="alert alert-danger">
								<i class="fa fa-close"><span> Permission to wrtie to HTACCESS File (.htaccess) is denied</span></i>
							</div>
						<?php } else{?>
							<div class="alert alert-success">
								<i class="fa fa-check"><span> HTACCESS file is writable</span></i>
							</div>
						<?php } ?>
						<button id="activate-step-2" class="btn btn-primary btn-lg">Next step</button>
					</div>
				</div>
			</div>
		</div>
	
		<div class="container">
			<div class="row setup-content" id="step-2">
				<div class="col-xs-8 col-xs-offset-2">
					<div id="account_error" class="alert alert-danger" style="display:none">
					  All red fields are required.
					</div>
					<div class="col-md-12 well text-center">	                
						<div class="form-group">
							<label for="username" class="label label-primary">
								Grizzlysts Username
							</label>
							<input type="text" id="username" name="lic_username" class="form-control account">
						</div>
						<div class="form-group">
							<label for="password" class="label label-primary">
								Grizzlysts Password
							</label>
							<input type="password" id="password" name="lic_password" class="form-control account">
						</div>
						<div class="form-group">
							<label for="license" class="label label-primary">
								License Key
							</label>
							<input type="text" id="license" name="lic_key" class="form-control account">
						</div>
						<button id="activate-step-3" class="btn btn-primary btn-lg">Next step</button>
					</div>
				</div>
			</div>	
		</div>
		
		<div class="container">
			<div class="row setup-content" id="step-3">
				<div class="col-xs-8 col-xs-offset-2">
					<div id="database_error" class="alert alert-danger" style="display:none">
					  All red fields are required.
					</div>
					<div class="col-md-12 well text-center">	   
						<div class="form-group">
							<label for="db_host" class="label label-primary">
								Database host
							</label>
							<input type="text" name="db_host" id="db_host" class="form-control db">
						</div>
						<div class="form-group">
							<label for="db_username" class="label label-primary">
								Database username
							</label>
							<input type="text" name="db_username" id="db_username" class="form-control db">
						</div>
						<div class="form-group">
							<label for="db_password" class="label label-primary">
								Database password
							</label>
							<input type="password" id="db_password" class="form-control">
						</div>
						<div class="form-group">
							<label for="db_name" class="label label-primary">
								Database name
							</label>
							<input type="text" id="db_name" class="form-control db">
						</div>
	                	<button id="activate-step-4" class="btn btn-primary btn-lg">Next step</button>
					</div>
				</div>
			</div>	
		</div>
	
		
	
		<div class="container">	    
			<div class="row setup-content" id="step-4">
				<div class="col-xs-8 col-xs-offset-2">
					<div id="account_error" class="alert alert-danger" style="display:none">
						  All red fields are required.
					</div>
					<div class="col-md-12 well">
						<fieldset>
							<legend>Default Settings</legend>
							<div class="form-group">
								<label for="domain_name" class="label label-primary">
									Website title
								</label>
								<input type="text" name="domain_name" id="domain_name" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="smtp_host" class="label label-primary">
									SMTP host
								</label>
								<input type="text" name="smtp_host" id="smtp_host" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="smtp_user" class="label label-primary">
									SMTP user
								</label>
								<input type="text" name="smtp_user" id="smtp_user" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="smtp_pass" class="label label-primary">
									SMTP pass
								</label>
								<input type="password" name="smtp_pass" id="smtp_pass" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="verify_smtp_pass" class="label label-primary">
									Verify SMTP pass
								</label>
								<input type="password" name="verify_smtp_pass" id="verify_smtp_pass" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="smtp_port" class="label label-primary">
									SMTP port
								</label>
								<input type="text" name="smtp_port" id="smtp_port" class="form-control basic_setting">
							</div>
						</fieldset>
						<fieldset>
							<legend>Default Admin</legend>
							<div class="form-group">
								<label for="admin_first_name" class="label label-primary">
									Admin first name
								</label>
								<input type="text" name="admin_first_name" id="admin_first_name" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="admin_last_name" class="label label-primary">
									Admin last name
								</label>
								<input type="text" name="admin_last_name" id="admin_last_name" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="admin_username" class="label label-primary">
									Admin username
								</label>
								<input type="text" name="admin_username" id="admin_username" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="admin_password" class="label label-primary">
									Admin password
								</label>
								<input type="password" name="admin_password" id="admin_password" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="admin_password" class="label label-primary">
									Verify password
								</label>
								<input type="password" name="admin_verify_password" id="admin_verify_password" class="form-control basic_setting">
							</div>
							<div class="form-group">
								<label for="admin_email" class="label label-primary">
									Admin email
								</label>
								<input type="text" name="admin_email" id="admin_email" class="form-control basic_setting">
							</div>               
							<div class="form-group">
								<label for="admin_verify_email" class="label label-primary">
									Verify email
								</label>
								<input type="text" name="admin_verify_email" id="admin_verify_email" class="form-control basic_setting">
								<?=form_error("admin_verify_email")?>
							</div> 
							</fieldset>              
						<input type="submit" id="finish_setup" class="btn btn-success btn-lg" value="Finish setup">
					</div>
				</div>
			</div>	
		</div>
	</body>
	<script>
	$(document).ready(function(){
		var navListItems = $('ul.setup-panel li a'),
		allWells = $('.setup-content');
		
		allWells.hide();
		
		navListItems.click(function(e){
			e.preventDefault();
			var $target = $($(this).attr('href')),
			$item = $(this).closest('li');
				        
			if(!$item.hasClass('disabled')){
				navListItems.closest('li').removeClass('active');
				$item.addClass('active');
				allWells.hide();
				$target.show();
			}
		});
			    
		$('ul.setup-panel li.active a').trigger('click');

		if($("#step-1 div").hasClass("alert-danger")){
			$("#activate-step-2").attr("disabled", "disabled");
		}
		
		//STEP 1			    
		$('#activate-step-2').on('click', function(e){
			$('ul.setup-panel li:eq(1)').removeClass('disabled');
			$('ul.setup-panel li a[href="#step-2"]').trigger('click');
			$(this).remove();
		});


	    //STEP 2
		$('#activate-step-3').on('click', function(e) {
			var username = $("#username").val();
			var password = $("#password").val();
			var key = $("#license").val();
			var errorCount = 0;

			$(".account").each(function(){
				if($(this).val() == ""){
					errorCount++;
					$(this).css("border-color", "#ff6363");
				}
				else{
					$(this).css("border-color", "");
				}
			});

			if(errorCount == 0){
				$.ajax({
					url: "<?=base_url()?>index.php/installer/license",
					type: 'POST',
					data: {"lic_username" : username,
							"lic_password" : password,
							"lic_key" : key
					},
					beforeSend: function(){
						$('#activate-step-3').attr("disabled", "disabled");
					},
					success: function(data){
						$('#activate-step-3').attr("disabled", false);
						
						if(data == 0){
							toastr.error("Invalid credentials");
						}
						else{
							$('ul.setup-panel li:eq(2)').removeClass('disabled');
							$('ul.setup-panel li a[href="#step-3"]').trigger('click');
							$(this).remove();
						}
					}
				});
			}
			
		});

		//STEP 3
		$('#activate-step-4').on('click', function(e) {
			var host = $("#db_host").val();
			var username = $("#db_username").val();
			var password = $("#db_password").val();
			var database = $("#db_name").val();
			var errorCount = 0;
			
			$(".db").each(function(){
				if($(this).val() == ""){
					errorCount++;
					$(this).css("border-color", "#ff6363");
				}
				else{
					$(this).css("border-color", "");
				}
			});

			if(errorCount == 0){
				$.ajax({
					url: "<?=base_url()?>index.php/installer/database",
					type: 'POST',
					data: {"host" : host,
							"username" : username,
							"password" : password,
							"database" : database
					},
					beforeSend: function(){
						$('#activate-step-4').attr("disabled", "disabled");
					},
					success: function(data){
						$('#activate-step-4').attr("disabled", false);
						
						if(data == 0){
							toastr.error("Invalid credentials");
						}
						else{
							$('ul.setup-panel li:eq(3)').removeClass('disabled');
							$('ul.setup-panel li a[href="#step-4"]').trigger('click');
							$(this).remove();
						}
					}
				});
			}
		});


		//STEP 4
		$('#finish_setup').on('click', function(e) {
			var domain = $("#domain_name").val();
			var firstName = $("#admin_first_name").val();
			var lastName = $("#admin_last_name").val();
			var username = $("#admin_username").val();
			var password = $("#admin_password").val();
			var verify_password = $("#admin_verify_password").val();
			var email = $("#admin_email").val();
			var verify_email = $("#admin_verify_email").val();
			var smtpHost = $("#smtp_host").val();
			var smtpUser = $("#smtp_user").val();
			var smtpPass = $("#smtp_pass").val();
			var smtpPort = $("#smtp_port").val();
			var errorCount = 0;

			$(".basic_setting").each(function(){
				if($(this).val() == ""){
					errorCount++;
					$(this).css("border-color", "#ff6363");
				}
				else{
					$(this).css("border-color", "");
				}
			});

			if($("#admin_password").val() != $("#admin_verify_password").val()){
				$("#admin_verify_password").css("border-color", "#ff6363");
				toastr.error("Password do not match");
				errorCount++;
			}
			else{
				$("#admin_verify_password").css("border-color", "");
			}

			
			if($("#admin_email").val() != $("#admin_verify_email").val()){
				$("#admin_verify_email").css("border-color", "#ff6363");
				toastr.error("Email do not match");
				errorCount++;
			}
			else{
				$("#admin_verify_email").css("border-color", "");
			}

			
			if($("#smtp_pass").val() != $("#verify_smtp_pass").val()){
				$("#verify_smtp_pass").css("border-color", "#ff6363");
				toastr.error("SMTP password do not match");
				errorCount++;
			}
			else{
				$("#verify_smtp_pass").css("border-color", "");
			}

			
			if(errorCount == 0){
				$.ajax({
					url: "<?=base_url()?>index.php/installer/settings",
					type: 'POST',
					data: {"set_domain" : domain,
							"set_first_name" : firstName,
							"set_last_name" : lastName,
							"set_username" : username,
							"set_password" : password,
							"set_email" : email,
							"smtp_host" : smtpHost,
							"smtp_user" : smtpUser,
							"smtp_pass" : smtpPass,
							"smtp_port" : smtpPort
					},
					beforeSend: function(){
						$('#finish_setup').attr("disabled", "disabled");
					},
					success: function(data){
						$('#finish_setup').attr("disabled", false);
						
						if(data == 0){
							toastr.error("An error occurred. Please try again.");
						}
						else{
							location.replace("admin");
						}

						console.log(data);
					},
					error: function(a,b,c){
						console.log(a);
						console.log(b);
						console.log(c);
					}
				});
			}
			
		});
	});

	</script>
</html>