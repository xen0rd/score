<h1>SMTP CONFIGURATION</h1>
<div class="container">
	<?=form_open(current_url(), 'autocomplete="off"')?>
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label for="smtp_host" class="label label-danger">SMTP host</label>
					<input type="text" name="smtp_host" id="smtp_host" class="form-control" value="<?=NULL != set_value('smtp_host') ? set_value('smtp_host') : $smtp->smtp_host?>">
					<?=form_error('smtp_host')?>
				</div>
				<div class="form-group">
					<label for="smtp_user" class="label label-danger">SMTP user</label>
					<input type="text" name="smtp_user" id="smtp_user" class="form-control" value="<?=NULL != set_value('smtp_user') ? set_value('smtp_user') : $smtp->smtp_user?>">
					<?=form_error('smtp_user')?>
				</div>
				<div class="form-group">
					<label for="smtp_pass" class="label label-danger">SMTP password</label>
					<input type="password" name="smtp_pass" id="smtp_pass" class="form-control" value="<?=NULL != set_value('smtp_pass') ? set_value('smtp_pass') : $smtp->smtp_pass?>">
					<?=form_error('smtp_pass')?>
				</div>
				<div class="form-group">
					<label for="smtp_port" class="label label-danger">SMTP port</label>
					<input type="text" name="smtp_port" id="smtp_port" class="form-control" value="<?=NULL != set_value('smtp_port') ? set_value('smtp_port') : $smtp->smtp_port?>">
					<?=form_error('smtp_port')?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary">
		</div>
	<?=form_close();?>
</div>
<script>
	$(function(){
		$("input").keyup(function(){
			$(this).closest('div').find('.alert').fadeOut();
		});
	});
</script>