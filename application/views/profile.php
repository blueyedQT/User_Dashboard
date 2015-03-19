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
<?php 	if(!empty($errors)) { ?>
		<div class="row alert alert-danger" role="alert">
			<span class="sr-only">Message:</span>
			<?php echo $errors ?>
		</div>
<?php	} ?>
		<div class="row">
			<h1>Leave a message for <?php echo $user_info['first_name'] ?></h1>
			<form role="form" class="message_form" action="/post_message/<?php echo $user_info['id'] ?>" method="post">
				<div class="form-group">
					<textarea id="textarea_message" class="form-control" rows="3" name="message"></textarea>
				</div>
				<button class="col-md-2 col-md-offset-10 btn btn-primary button_margin" type="submit">Post Message</button>
			</form>
		</div>
		<div id="all_messages">
<?php	if(!empty($messages)) { 
			foreach($messages as $message) {
				if($message['id'] !== null) { ?>
			<div class="row">
				<p class="col-md-10">
					<a href="/profile/<?php echo $message['user_id'] ?>">
<?php 				if($message['user_id'] !== $user) {
						echo $message['message_name'];
					} else {
						echo 'You';
					} ?>
					</a> wrote:
				</p>
				<p class="col-md-2 text-right"><?php echo timeAgo($message['created_at']) ?></p>
			</div>
			<div class="row message"><?php echo $message['message'] ?></div>
			<div class="message_<?php echo $message['id'] ?>">
<?php 				if(!empty($comments)) {
						foreach($comments as $comment) {
							if($comment['message_id'] == $message['id']) { ?>
				<div class="row">
					<p class="col-md-9 col-md-offset-1">
						<a href="#">
<?php 							if($comment['created_user_id'] == $user) {
									echo 'You';
								} else {
									echo $comment['comment_name'];
								} ?>
						</a> wrote:
					</p>
					<p class="col-md-2 text-right"><?php echo timeAgo($comment['created_at']) ?></p>
				</div>
				<div class="row">
					<div class="outline comment col-md-11 col-md-offset-1"><?php echo $comment['comment'] ?></div>
				</div>
<?php 						}
						}
					} ?>
			</div>
			<form role="form" class="col-md-offset-1" action="/post_comment/<?php echo $message['id'] ?>" method="post">
				<div class="row form-group">
					<textarea class="form-control" name="comment"></textarea>
				</div>
				<input type="hidden" name="user" value="<?php echo $user_info['id'] ?>">
				<div class="row">
					<button class="col-md-2 col-md-offset-10 btn btn-success button_margin" type="submit">Post Comment</button>
				</div>
			</form>
<?php			}
	 		}
		} ?>
		</div>
	</div>
	<div class="footer">
	</div>
</body>

<?php  	
	function timeAgo($timestamp){
		$timeCalc = time() - strtotime($timestamp);
		if($timeCalc > (24 * 60 * 60)){
			$time = date('M d, Y', strtotime($timestamp));
			return $time;
		} else if($timeCalc > (60 * 60)){
			$timeCalc = round($timeCalc/60/60) . " hours ago";
		} else {
			$timeCalc = round($timeCalc/60) . " minutes ago";
		}
		return $timeCalc;
	} 
?>

<script type="text/javascript">
	$(document).on("submit", "form", function(){
		thisOne = this;
		$.post(
			$(this).attr('action'),
			$(this).serialize(),
			function(output) {
				if(output.action == 'add_message'){
					$('textarea').val('');
					$('#all_messages').prepend(
						"<div class='row'>"+
							"<p class='col-md-10'><a href='/profile/"+output.user_id+"'>You </a>wrote:</p>"+
							"<p class='col-md-2 text-right'>1 minute ago</p>"+
						"</div>"+
						"<div class='row message'>"+output.message+"</div>"+				
						"<form role='form' class='col-md-offset-1' action='/post_comment/'"+output.id+"' method='post'>"+
							"<div class='row form-group'>"+
								"<textarea class='form-control' name='comment'></textarea>"+
							"</div>"+
							"<input type='hidden' name='user' value='"+output.user_id+"'>"+
							"<div class='row'>"+
								"<button class='col-md-2 col-md-offset-10 btn btn-success button_margin' type='submit'>Post Comment</button>"+
							"</div>"+
						"</form>");
				} else if(output.action == 'add_comment'){
					$('textarea').val('');
					$('.message_'+output.message_id).append(
						'<div class="row">'+
							'<p class="col-md-9 col-md-offset-1"><a href="'+output.user_id+'">You</a> wrote:</p>'+
							'<p class="col-md-2 text-right">1 minute ago</p>'+
						'</div>'+
						'<div class="row">'+
							'<div class="outline comment col-md-11 col-md-offset-1">'+output.comment+'</div>'+
						'</div>');
				}
			}, "json"
		);
		return false;
	});
</script>
</html>