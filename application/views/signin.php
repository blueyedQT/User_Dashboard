	<div class="container">
		<h1>Sign In</h1>
		<form class="col-md-4" action="signin_user" method="post">
			<fieldset>
				<?php if(!empty($errors)) { ?>
				<div class="alert alert-danger" role="alert">
					<span class="sr-only">Error:</span>
					<?php echo $errors ?>
				</div>
				<?php } ?>
				<!-- Need to come up with a better way of getting them stacked inline than paragraph tags I think -->
				<p><label>Email Address: </label></p>
				<p><input type="text" name="email" placeholder="xyz@example.com"></p>
				<p><label>Password: </label></p>
				<p><input type="password" name="password"></p>
				<p><button type="submit" class="btn">Sign In!</button></p>
			</fieldset>
			<a href="register">Don't have an account? Register</a>
		</form>
	</div>
</body>
</html>