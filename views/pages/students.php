<?php if(!defined('INDEX')) die('Direct access is prohibited!');?>
<?php if(!isset($_GET['ajax'])) : ?>
<div class="container">
	<ul class="nav nav-tabs">
		<li role="presentation"<?php if(!array_key_exists('scope', $_GET) || ($_GET['scope'] == 'all')) echo ' class="active"';?>><a href="index.php?page=students&scope=all">All students</a></li>
		<li role="presentation"<?php if(array_key_exists('scope', $_GET) && ($_GET['scope'] == 'new')) echo ' class="active"';?>><a href="index.php?page=students&scope=new">New Transfers</a></li>
		<li role="presentation"<?php if(array_key_exists('scope', $_GET) && ($_GET['scope'] == 'outstanding')) echo ' class="active"';?>><a href="index.php?page=students&scope=outstanding">Outstanding Transfers</a></li>
		<li role="presentation"<?php if(array_key_exists('scope', $_GET) && ($_GET['scope'] == 'undecided')) echo ' class="active"';?>><a href="index.php?page=students&scope=undecided">Undecided</a></li>
		<li class="pull-right">
			<form class="form-inline" method="get">
				<div class="form-group">
					<input type="hidden" value="students" name="page">
					<?php if(array_key_exists('scope', $_GET)) echo '<input type="hidden" value="'.$_GET['scope'].'" name="scope">';?>
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for students" id="student-search" name='name'>
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</span>
					</div><!-- /input-group -->
				</div>
			</form>
		</li>
	</ul>
</div><br>
<div class="container" id="students">
<?php endif;?>
	<table class="table table-hover">
		<thead>
			<tr>
				<td><b>#</b></td>
				<td><b><a href="index.php<?php echo (preg_match('/(orderBy\=[\w\d\-\_\.]+)/', $url, $matches) ? str_replace($matches[0], 'orderBy=last_name', $url) : $url.'orderBy=last_name&order=asc') ?>">Student</a></b></td>
				<td><b><a href="index.php<?php echo (preg_match('/(orderBy\=[\w\d\-\_\.]+)/', $url, $matches) ? str_replace($matches[0], 'orderBy=sid', $url) : $url.'orderBy=sid&order=asc') ?>">SID</a></b></td>
				<td><b><a href="index.php<?php echo (preg_match('/(orderBy\=[\w\d\-\_\.]+)/', $url, $matches) ? str_replace($matches[0], 'orderBy=work_phone', $url) : $url.'orderBy=work_phone&order=asc') ?>">Phone</a></b></td>
			</tr>
		</thead>
		<?php
		if(!empty($students)) {
			$i = 0;
			foreach ($students as $student) {
				$i++;
				
				echo "	<tr>
							<td><b>$i</b></td>
							<td>$student[first_name] $student[last_name]</td>
							<td><a href='index.php?page=transfer&sid=$student[sid]'>".sid_format($student['sid'])."</a></td>
							<td>".phone_format($student['work_phone'],'(,) , - ')."</td>
						</tr>";
			}
		} else {
			echo '<tr><td colspan="4">No students to display.</td></tr>';
		}
		?>
	</table>
<?php if(!isset($_GET['ajax'])) :?>
</div>
<?php endif; ?>