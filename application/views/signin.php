	<div class="container">
		<h1>Sign In</h1>
		<form role="form" class="col-md-5" action="signin_user" method="post">
<?php 		if(!empty($errors)) { ?>
				<div class="alert alert-danger" role="alert">
					<span class="sr-only">Error:</span>
					<?php echo $errors ?>
				</div>
<?php 		} ?>
			<div class="form-group">
				<label for="email">Email Address:</label>
				<input class="form-control" type="text" name="email" placeholder="xyz@example.com">
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input class="form-control" type="password" name="password">
			</div>
			<div class="form-group">	
				<button type="submit" class="btn btn-success">Sign In!</button>
			</div>
			<a href="register">Don't have an account? Register</a>
		</form>
	</div>
</body>
</html>