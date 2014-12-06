	<div class="container">
		<div class="row">
			<h1 class="col-md-4">All Users</h1>
		</div>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created</th>
					<th>User Level</th>
				</tr>
			</thead>
			<tbody>
<?php 		foreach ($users as $user) { ?>
				<tr>
					<td><?php echo $user['id'] ?></td>
					<td><a href="/profile/<?php echo $user['id'] ?>"><?php echo $user['user_name'] ?></a></td>
					<td><?php echo $user['email'] ?></td>
					<td><?php echo $user['created'] ?></td>
					<td><?php echo $user['level'] ?></td>
				</tr>
<?php 		} ?>
			</tbody>
		</table>
	</div>
</body>
</html>