	<div class="container">
		<h1>Edit Profile</h1>
		<div class="row">
			<form role="form" class="col-md-4 multiple" action="/edit_user" method="post">
				<legend>Edit Information</legend>
				<div class="form-group">
					<label for="email">Email Address:</label>
					<input class="form-control" type="text" name="email" value="<?php echo $user_info['email'] ?>">
				</div>
				<div class="form-group">
					<label for="first_name">First Name:</label>
					<input class="form-control" type="text" name="first_name" value="<?php echo $user_info['first_name'] ?>">
				</div>
				<div class="form-group">
					<label for="last_name">Last Name:</label>
					<input class="form-control" type="text" name="last_name" value="<?php echo $user_info['last_name'] ?>">
				</div>
				<input type="hidden" name="id" value="<?php echo $user_info['id'] ?>">
				<button class="btn btn-primary" type="submit" name="submit">Save</button>
			</form>
			<form role="form" class="col-md-4 col-md-offset-2 multiple" action="/edit_password" method="post">
				<legend>Change Password</legend>
				<div class="form-group">
					<label for="password">Password:</label>
					<input class="form-control" type="password" name="password">
				</div>
				<div class="form-group">
					<label for="password2">Confirm Password:</label>
					<input class="form-control" type="password" name="password2">
				</div>
				<input type="hidden" name="id" value="<?php echo $user_info['id'] ?>">
				<button class="btn btn-primary" type="submit" name="submit">Update Password</button>
			</form>
		</div>
		<form role="form" class="multiple" action="/edit_description" method="post">
			<legend>Edit Description</legend>
			<div class="form-group">
				<textarea class="form-control" name="description"></textarea>
			</div>
			<input type="hidden" name="id" value="<?php echo $user_info['id'] ?>">
			<button class="btn btn-primary" type="submit" name="submit">Save<button>
		</form>
	</div>
</body>
</html>