	<div class="container">
		<div class="row">
			<h1 class="col-md-10">Manage Users</h1>
			<a href="add_new"><button class="btn btn-lg btn-primary">Add New</button></a>
		</div>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created</th>
					<th>User Level</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
<?php 		foreach ($users as $user) { ?>
				<tr>
					<td><?php echo $user['id'] ?></td>
					<td><a href="profile/<?php echo $user['id'] ?>"><?php echo $user['user_name'] ?></a></td>
					<td><?php echo $user['email'] ?></td>
					<td><?php echo $user['created'] ?></td>
					<td><?php echo $user['level'] ?></td>
					<td><a href="edit/<?php echo $user['id'] ?>">Edit</a> <a class="delete" href="delete/<?php echo $user['id'] ?>">Remove</a></td>
				</tr>
<?php 		} ?>
			</tbody>
		</table>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$('.delete').click(function(){
			var answer = confirm('Are you sure?');
			console.log(answer);
		});
	});
</script>
</html>