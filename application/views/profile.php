<?php var_dump($messages); ?>
	<div class="container">
		<div class="row">
			<h1 class="col-md-4"><?php echo $user_info['first_name'].' '.$user_info['last_name'] ?></h1>
		</div>
		<p>Registered at: <?php echo $user_info['created_at'] ?></p>
		<p>User ID: <?php echo $user_info['id'] ?></p>
		<p>Email Address: <?php echo $user_info['email'] ?></p>
		<p>Description: <?php echo $user_info['description'] ?></p>
		<h1>Leave a message for <?php echo $user_info['first_name'] ?></h1>
		<form role="form" action="/post_message/<?php echo $user_info['id'] ?>" method="post">
			<textarea class="form-control" rows="3" name="message"></textarea>
			<input class="col-md-2 col-md-offset-10 btn btn-success" type="submit" name="submit" value="Post">
		</form>
<?php	if(!empty($messages)) {
	var_dump($messages); } ?>
		<div class="row">
			<p class="col-md-10">(FIRST NAME LAST NAME) wrote</p>
			<p class="col-md-2 text-right">(TIME AGO)</p>
		</div>
		<div class="outline message">(MESSAGE)</div>
		<div class="row">
			<p class="col-md-9 col-md-offset-1">(FIRST NAME LAST NAME) wrote</p>
			<p class="col-md-2 text-right">(TIME AGO)</p>
		</div>
		<div class="row">
			<div class="outline message col-md-11 col-md-offset-1">(COMMENT)</div>
		</div>
			<form class="col-md-offset-1" action="#" method="post">
				<textarea class="form-control">WRITE A MESSAGE HERE</textarea>
				<input class="col-md-2 col-md-offset-10 btn btn-success" type="submit" name="submit" value="post">
			</form>
	</div>
</body>
</html>