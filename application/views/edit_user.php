	<div class="container">
		<h1>Edit User #<?php echo $user_info['id'] ?></h1>
		<form action="#" method="post">
			<h4>Edit Information</h4>
			<p>Email Address:</p>
			<input type="text" name="email" value="<?php echo $user_info['email'] ?>">
			<p>First Name:</p>
			<input type="text" name="first_name" value="<?php echo $user_info['first_name'] ?>">
			<p>Last Name:</p>
			<input type="text" name="last_name" value="<?php echo $user_info['last_name'] ?>">
			<!-- format cleaner! -->
			<p><br><select name="admin">
				<option value="(VALUE)">(UWER LEVEL OPTIONS)</option>
			</select></p>
			<input class="btn btn-primary" type="submit" name="submit" value="Save">
		</form>
	</div>
</body>
</html>