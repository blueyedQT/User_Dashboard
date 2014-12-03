	<div class="container">
		<h1>Edit User #<?php echo $user_info['id'] ?></h1>
		<form action="/edit_user" method="post">
			<h4>Edit Information</h4>
			<p>Email Address:</p>
			<input type="text" name="email" value="<?php echo $user_info['email'] ?>">
			<p>First Name:</p>
			<input type="text" name="first_name" value="<?php echo $user_info['first_name'] ?>">
			<p>Last Name:</p>
			<input type="text" name="last_name" value="<?php echo $user_info['last_name'] ?>">
			<!-- format cleaner! -->
			<p>User Level: <select name="user_level">
<?php 		foreach($admin_levels as $level) { ?>
				<option value="<?php echo $level['id']?>" 
<?php 				if($level['id'] == $user_info['user_level']) {
						echo 'selected="selected"'; 
					} ?> ><?php echo $level['name'] ?></option>
<?php 		} ?>
			</select></p>
			<input type="hidden" name="id" value="<?php echo $user_info['id'] ?>">
			<input class="btn btn-primary" type="submit" name="submit" value="Save">
		</form>
	</div>
</body>
</html>