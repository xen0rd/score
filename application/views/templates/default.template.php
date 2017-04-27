<?php
echo link_tag(css_url()."bootstrap.css");
echo link_tag(css_url()."bootstrap-datepicker.css");
echo link_tag(css_url()."toastr.css");
echo link_tag(css_url()."admin-login.css");
?>
<html>
	<head>
		<meta charset="utf-8">
		<script src="<?=js_url().'jquery-3.1.1.min.js'?>"></script>
		<script src="<?=js_url().'bootstrap.js'?>"></script>
		<script src="<?=js_url().'bootstrap-datepicker.min.js'?>"></script>
		<script src="<?=js_url().'toastr.min.js'?>"></script>
	</head>
	<body>
		<?=$content;?>
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