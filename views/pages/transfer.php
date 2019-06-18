<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

//** Page contents **//
?>
<div class="container">
	<?php
	if($valid_sid) {
		
		?>
		<div class="col-md-3">
			<p>
				<address>
					<h4><?php echo $student['first_name']. ' '.$student['last_name'];?><br><small><?php echo $formatted_sid;?></small></h4>
					<?php echo $student['address'];?><br>
					<?php echo $student['city'];?>, <?php echo $student['state'];?> <?php echo $student['zip'];?><br>
					<abbr title="Phone">P:</abbr> <?php echo $formatted_phone;?>
				</address>		
			</p>
			<?php if($student_program) :?>
			<p>
				<b>Declared Program:</b><br>
				<?php echo $student_program['prog_desc'].'<br>('.date('M. d, Y',strtotime($student_program['declared_date'])).')';?><br>
				<?php if(in_array($_SESSION['user_role'], $student_access)){echo "<small><a href='index.php?page=transfer&sid=$sid&degree_change=1'>(Change)</a></small>";}?>
			</p>
			<?php endif;?>
		</div>
		<?php
				
		if($student_program) {
			
			// Display basic student info
			?>
			<div class="col-md-9">
				<h4>Institutions</h4>
				<small><span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i> Received</span> <span class="text-warning"><i class="glyphicon glyphicon-question-sign"></i> Not yet received</span></small><br>
				<?php 
				if(!empty($added_institutions)) {
					?>
					<table class="table table-hover">
						<thead>
							<tr>
								<td><b>Institution</b></td>
								<td><b>Added</b></td>
								<td><b>Status</b></td>
								<?php if(in_array($_SESSION['user_role'], $staff_access)) : ?>
								<td><b>Confirm</b></td>
								<?php endif;?>
								<?php if(in_array($_SESSION['user_role'], $student_access)) : ?>
								<td><b>Delete</b></td>
								<?php endif;?>
							</tr>
						</thead>
						<tbody>
					<?php
					foreach ($added_institutions as $institution) {
						$received = ($institution['received']) ? '<span class="text-success"><i class="glyphicon glyphicon-ok-sign"></i></span>' : '<span class="text-warning"><i class="glyphicon glyphicon-question-sign"></i></span>' ;
						echo "<tr><td>$institution[inst_name]</td><td>".date('l M. jS, Y', strtotime($institution['date_entered']))."</td><td align='center'><small>$received</small></td>";
												
						if(in_array($_SESSION['user_role'], $staff_access)) {
							echo "<td align='center'>";
							if(!$institution['received']) {
								echo "<a href='index.php?page=transfer&sid=$sid&confirm=$institution[id]'><i class='glyphicon glyphicon-ok text-success'></i></a>";
							}
							echo "</td>";
						}
						
						if(in_array($_SESSION['user_role'], $student_access)) {							
							echo "<td align='center'><a href='index.php?page=transfer&sid=$sid&delete=$institution[id]' class='confirm_delete'><i class='glyphicon glyphicon-remove text-danger'></i></a></td>";
						}
						
						echo '</tr>';
					}
					echo '</tbody></table>';
				} else {
					echo 'There are currently no institutions for the selected student.<br><br>';
				}
				if(in_array($_SESSION['user_role'], $student_access)) :?>
				<div class="institution-form" style="">
					<form class="form" method="post">
						<div class="form-group">					
							<div class="form-inline">
								<select class="form-control inst" id="institution" name="institution">
									<option>Select an institution</option>
									<?php
									if(!empty($institutions)) {
										foreach ($institutions as $institution) {
											echo '<option value="'.$institution['inst_id'].'">'.$institution['inst_name'].'</option>';
										}
									}
									?>
									<option value="other"<?php if($form_processed && !$form_valid && $inst_other) echo " selected='selected'";?>>Other</option>
								</select>
								<input class="form-control other-inst" type="text" name="other-inst"<?php if($form_valid || !$inst_other) echo ' style="display:none;"';?> placeholder="Institution Name">
								<button type="submit" class="btn btn-default" name="add-institution">Add Institution</button>
								<?php if($form_processed && !$form_valid) echo "<div class='text-danger'><br><i class='glyphicon glyphicon-remove'></i> $message</div>"?>
							</div>
						</div>
						
					</form>
				</div>
				<?php endif; ?>
			</div>
			<?php
			
		} elseif(in_array($_SESSION['user_role'], $student_access)) {
			// No program exists, must select here
			?>
			<div class="col-md-9">
				<b class="text-danger">To continue, please select a degree program below.</b><br><br>
				<form class="form-inline" method="post">
					<div class="form-group">
						<select class="form-control" name="program-id">
							<option>Select one</option>
							<optgroup label="Programs"></optgroup>
							<?php
							foreach ($program_list as $program) {
								echo "<option value=\"$program[prog_id]\">&nbsp;&nbsp;&nbsp;$program[prog_desc]</option>\n";
							}
							?>
						</select>
						<button class="btn btn-primary" type="submit" name="program">Select</button>
					</div>
				</form>
				<div>
					<?php
					if(isset($message)) {
						echo "$message";
					}
					?>
				</div>
			</div>
			<?php
		} else {
			?>
			<div class="col-md-9">
				<p>Student has not selected a degree program yet.</p>
			</div>
			<?php
		}
		
	} else {
		echo '<h3>No valid SID provided. Program is exiting...</h3>';
	}
	?>
</div>
<?php
//** END Page contents **//
?> 