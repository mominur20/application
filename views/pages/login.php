<?php
if(!defined('INDEX')) die('Direct access is prohibited!');

?>
<div class="container">
	<form class="form-signin" method="post">
		<?php if(isset($error_message)) :?>
		<span class="text-danger"><h4><i class="glyphicon glyphicon-remove"></i> <?php echo $error_message;?></h4></span>
		<?php endif;?>
		<h2 class="form-signin-heading">Login</h2>
		<label for="inputEmail" class="sr-only">Username</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="username" autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Sign in</button>
	</form>
</div> <!-- /container -->