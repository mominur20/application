<?php if(!defined('INDEX')) die('Direct access is prohibited!');?>
<div class="container">
	<h3>Student Entry Form</h3>
	<?php if(!$form_valid) {
		if(isset($database_error)) {?>
	<div class="alert alert-danger" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		<b>Error Updating the database: </b><?php echo $database_error;?>
	</div>
	<?php }?>
	<form class="form" method="post">
		<div class="col-md-6">
			<label for="name">Name</label>
			<div class="form-inline">
				<div class="form-group<?php if($form_processed && !$first_name)echo ' has-error has-feedback';else if($form_processed && $first_name)echo ' has-success has-feedback';?>">
					<input type="text" class="form-control" id="name" placeholder="First Name" name="first_name"<?php if($form_processed) echo " value='$_POST[first_name]'";?>>
					<?php if($form_processed && !$first_name) {?>
					<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  					<span id="inputError2Status" class="sr-only">(error)</span>
					<?php } else if($form_processed && $first_name) {?>
					<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  					<span id="inputSuccess2Status" class="sr-only">(success)</span>
					<?php }?>
				</div>
				<div class="form-group<?php if($form_processed && !$last_name)echo ' has-error has-feedback';else if($form_processed && $last_name)echo ' has-success has-feedback';?>">
					<input type="text" class="form-control" id="name" placeholder="Last Name" name="last_name"<?php if($form_processed) echo " value='$_POST[last_name]'";?>>
					<?php if($form_processed && !$last_name) {?>
					<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  					<span id="inputError2Status" class="sr-only">(error)</span>
					<?php } else if($form_processed && $last_name) {?>
					<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  					<span id="inputSuccess2Status" class="sr-only">(success)</span>
					<?php }?>
				</div>
			</div><br>
			<label for="sid">SID</label>
			<div class="form-inline">
				<div class="form-group<?php if($form_processed && !$sid)echo ' has-error has-feedback';else if($form_processed && $sid)echo ' has-success has-feedback';?>">
					<input type="text" class="form-control" id="sid" placeholder="880 - XX - XXXX" name="sid"<?php if($form_processed) echo " value='$_POST[sid]'";?>>
					<?php if($form_processed && !$sid) {?>
					<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  					<span id="inputError2Status" class="sr-only">(error)</span>
					<?php } else if($form_processed && $sid) {?>
					<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  					<span id="inputSuccess2Status" class="sr-only">(success)</span>
					<?php }?>
				</div>
			</div><br>
			<label for="phone">Phone</label>
			<div class="form-inline">
				<div class="form-group<?php if($form_processed && !$phone)echo ' has-error has-feedback';else if($form_processed && $phone)echo ' has-success has-feedback';?>">
					<input type="text" class="form-control" id="phone" placeholder="(XXX) - XXX - XXXX" name="phone"<?php if($form_processed) echo " value='$_POST[phone]'";?>>
					<?php if($form_processed && !$phone) {?>
					<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  					<span id="inputError2Status" class="sr-only">(error)</span>
					<?php } else if($form_processed && $phone) {?>
					<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  					<span id="inputSuccess2Status" class="sr-only">(success)</span>
					<?php }?>
				</div>
			</div><br>
			<div class="form-group">
				<label for="gender">Gender</label>
				<div class="form-inline">
					<input type="radio" name="gender" value="m"<?php if($form_processed && $gender == 'm') echo ' checked="checked"'; ?>> Male&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="f"<?php if($form_processed && $gender == 'f') echo ' checked="checked"'; ?>> Female
					<?php if($form_processed && !$gender) echo '<p class="text-danger"><b>Please Select a gender</b></p>';?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<label for="address">Street Address</label>
			<div class="form-inline">
				<div class="form-group<?php if($form_processed && !$address)echo ' has-error has-feedback';else if($form_processed && $address)echo ' has-success has-feedback';?>">
					<input type="text" class="form-control" id="address" placeholder="123rd St NE" name="address"<?php if($form_processed) echo " value='$_POST[address]'";?>>
					<?php if($form_processed && !$address) {?>
					<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  					<span id="inputError2Status" class="sr-only">(error)</span>
					<?php } else if($form_processed && $address) {?>
					<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  					<span id="inputSuccess2Status" class="sr-only">(success)</span>
					<?php }?>
				</div>
			</div><br>
			<div class="form-group">
				<label for="city">City/State</label>
				<div class="form-inline">
					<div class="form-group<?php if($form_processed && !$city)echo ' has-error has-feedback';else if($form_processed && $city)echo ' has-success has-feedback';?>">
						<input type="text" class="form-control" id="city" placeholder="Des Moines" name="city"<?php if($form_processed) echo " value='$_POST[city]'";?>>
						<?php if($form_processed && !$city) {?>
						<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
	  					<span id="inputError2Status" class="sr-only">(error)</span>
						<?php } else if($form_processed && $city) {?>
						<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
	  					<span id="inputSuccess2Status" class="sr-only">(success)</span>
						<?php }?>
					</div>
					<select class="form-control" name="state">
						<option selected="selected">Select One</option>
						<?php
						foreach ($states_array as $key => $value) {
							echo '<optgroup label="'.ucwords(str_replace('_', ' ', $key)).'">';
							foreach ($value as $state_short => $state_long) {
								$selected = ($form_processed && $state == $state_short) ? 'selected="selected"' : '' ;
								echo '<option value="'.$state_short.'" '.$selected.'>'.ucwords($state_long).'</option>';
							}
							echo '</optgroup>';
						}
						?>
					</select>
				</div>
			</div>
			<label for="zip">Zip</label>
			<div class="form-inline">
				<div class="form-group<?php if($form_processed && !$zip)echo ' has-error has-feedback';else if($form_processed && $zip)echo ' has-success has-feedback';?>">
					<input type="text" class="form-control" id="zip" placeholder="XXXXX - XXXX" name="zip"<?php if($form_processed) echo " value='$_POST[zip]'";?>>
					<?php if($form_processed && !$zip) {?>
					<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  					<span id="inputError2Status" class="sr-only">(error)</span>
					<?php } else if($form_processed && $zip) {?>
					<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
  					<span id="inputSuccess2Status" class="sr-only">(success)</span>
					<?php }?>
				</div>  <small>(Last four optional)</small>
			</div><br>
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary" name="submit">Submit</button>&nbsp;<input type="reset" class="btn btn-warning"></input>
		</div>
	</form>
	<?php } else {?>
	<div class="alert alert-success" role="alert">
		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
		<span class="sr-only">Success:</span>
		<b>Database Successfully Updated!</b><br><br>
		<form method="get"><input type="hidden" name="page" value="entryForm"><button type="submit" class="btn btn-success">Insert More!</button></form>
	</div>
	<?php }?>
</div>