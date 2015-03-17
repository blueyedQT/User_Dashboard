<?php var_dump($messages) ?>
	<div class="container">
		<div class="row">
			<h1><?php echo $user_info['first_name'].' '.$user_info['last_name'] ?></h1>
		</div>
		<div class="row">
			<p>Registered on: <?php echo $user_info['created'] ?></p>
			<p>User ID: <?php echo $user_info['id'] ?></p>
			<p>Email Address: <?php echo $user_info['email'] ?></p>
			<p>Description: <?php echo $user_info['description'] ?></p>
		</div>
		<div class="row">
			<h1>Leave a message for <?php echo $user_info['first_name'] ?></h1>
			<form role="form" action="/post_message/<?php echo $user_info['id'] ?>" method="post">
				<div class="form-group">
					<textarea class="form-control" rows="3" name="message"></textarea>
				</div>
				<button class="col-md-2 col-md-offset-10 btn btn-primary" type="submit">Post Message</button>
			</form>
		</div>
<?php	if(!empty($messages)) { 
			foreach($messages as $message) { ?>
		<div class="row">
			<h4 class="col-md-10"><a href="/profile/<?php echo $message['user_id'] ?>"><?php echo $message['message_name'] ?></a> wrote</h4>
			<p class="col-md-2 text-right"><?php echo $message['created_at'] ?></p>
		</div>
		<div class="row message outline"><?php echo $message['message'] ?></div>
<?php 			if(!empty($comments)) {
					foreach ($comments as $comment) {
						if($comment['message_id'] == $message['id']) { ?>
		<div class="row">
			<p class="col-md-9 col-md-offset-1"><a href="#"><?php echo $comment['comment_name'] ?></a> wrote</p>
			<p class="col-md-2 text-right"><?php echo $comment['created_at'] ?></p>
		</div>
		<div class="row">
			<div class="outline comment col-md-11 col-md-offset-1"><?php echo $comment['comment'] ?></div>
		</div>	
<?php 					}
					}
				} ?>
		<form role="form" class="col-md-offset-1" action="/post_comment/<?php echo $message['id'] ?>" method="post">
			<div class="row form-group">
				<textarea class="form-control" name="comment">WRITE A COMMENT HERE</textarea>
			</div>
			<input type="hidden" name="user" value="<?php echo $user_info['id'] ?>">
			<div class="row">
			<button class="col-md-2 col-md-offset-10 btn btn-success" type="submit">Post Comment</button>
		</div>
		</form>
<?php	 	}
		} ?>



		<h4>PLACEMENT ONLY</h4>
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