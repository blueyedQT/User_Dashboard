	<div class="container">
		<div class="row">
			<h1 class="col-md-9">Add User</h1>
			<a href="/dashboard/admin"><button class="btn btn-lg btn-primary">Return to Dashboard</button></a>
		</div>
		<form role="form" class="col-md-5" action="register_user" method="post">
<?php 		if(!empty($errors)) { ?>
			<div class="alert alert-danger" role="alert">
				<span class="sr-only">Error:</span>
				<?php echo $errors ?>
			</div>
<?php		} ?>
			<div class="form-group">
				<label for="email">Email Address:</label>
				<input class="form-control" type="text" name="email" placeholder="xyz@example.com">
			</div>
			<div class="form-group">
				<label for="first_name">First Name:</label>
				<input class="form-control" type="text" name="first_name" placeholder="John">
			</div>
			<div class="form-group">
				<label for="last_name">Last Name:</label>
				<input class="form-control" type="text" name="last_name" placeholder="Doe">
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input class="form-control" type="password" name="password">
			</div>
			<div class="form-group">
				<label for="password2">Password Confirmation:</label>
				<input class="form-control" type="password" name="password2">
			</div>
			<button type="submit" name="submit" class="btn btn-success">Add User</button>
		</form>
	</div>
</body>
</html>