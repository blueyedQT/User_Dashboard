	<div class="container">
		<h1>Register</h1>
		<form class="col-md-4" action="register_user" method="post">
			<fieldset>
				<?php if(!empty($errors)) { ?>
				<div class="alert alert-danger" role="alert">
					<span class="sr-only">Error:</span>
					<?php echo $errors ?>
				</div>
				
			<?php	} ?>
				<!-- Need to come up with a better way of getting them stacked inline than paragraph tags I think -->
				<p><label>Email Address: </label></p>
				<p><input type="text" name="email" placeholder="xyz@example.com"></p>
				<p><label>First Name: </label></p>
				<p><input type="text" name="first_name" placeholder="John"></p>
				<p><label>Last Name: </label></p>
				<p><input type="text" name="last_name" placeholder="Doe"></p>
				<p><label>Password: </label></p>
				<p><input type="password" name="password"></p>
				<p><label>Password Confirmation: </label></p>
				<p><input type="password" name="password2"></p>
				<p><button type="submit" name="submit" class="btn">Sign In!</button></p>
			</fieldset>
			<a href="signin">Already have an account? Login</a>
		</form>
	</div>
</body>
</html>