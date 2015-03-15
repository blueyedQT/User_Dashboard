	<div class="container">
		<h1>Edit Profile</h1>
		<div class="row">
			<form class="col-md-3" action="/edit_user" method="post">
				<legend>Edit Information</legend>
				<p>Email Address:</p>
				<input type="text" name="email" value="<?php echo $user_info['email'] ?>">
				<p>First Name:</p>
				<input type="text" name="first_name" value="<?php echo $user_info['first_name'] ?>">
				<p>Last Name:</p>
				<input type="text" name="last_name" value="<?php echo $user_info['last_name'] ?>">
				<input type="hidden" name="id" value="<?php echo $user_info['id'] ?>">
				<input class="btn btn-primary" type="submit" name="submit" value="Save">
			</form>
			<form class="col-md-3 col-md-offset-2" action="/edit_password" method="post">
				<legend>Change Password</legend>
				<p>Password:</p>
				<input type="password" name="password">
				<p>Confirm Password:</p>
				<input type="password" name="password2">
				<input type="hidden" name="id" value="<?php echo $user_info['id'] ?>">
				<p><input class="btn btn-primary" type="submit" name="submit" value="Update Password"></p>
			</form>
			<form class="form" action="/edit_description" method="post">
				<legend>Edit Description</legend>
				<textarea name="description"></textarea>
				<input type="hidden" name="id" value="<?php echo $user_info['id'] ?>">
				<p><input class="btn btn-primary" type="submit" name="submit" value="Save"></p>
			</form>
		</div>
	</div>
</body>
</html>