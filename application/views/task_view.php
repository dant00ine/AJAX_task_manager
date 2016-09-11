<html>
<head>
	<title>Task Manager</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<script type="text/javascript" src = "/assets/jquery-2.1.4.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			$.get("/notes/generate_notes", function(res){

				// console.log(res.notes);

				for(var i = 0; i < res.notes.length; i++){
          			$(".col-md-12").append("<div class =\'col-md-1\'><p>"+res.notes[i].post+"</p></div>");
          		}

			}, 'json');

			$('form').submit(function(){

				$.post('/notes/addNote', $(this).serialize(), function(event){
					console.log(event);
					event.preventDefault();
				}, 'json');
			});
		});

	</script>
</head>
<body>
	<div id="container">
		<?php
			$user = $this->session->userdata['user'];
			// $all_messages = $this->session->userdata['all_messages'];
		 ?>
		<h1>The Wall
			<a style="float: right; font-size: 12;" href="<?= base_url('loginregister/logout') ?>">Logout</a>
		</h1>
		<h3 style = "padding-left: 10px;">Hello, <?= $user['first_name'] ?>. Make a post here or respond to something below!</h3>


		<form action="<?= base_url('messages/add_message') ?>" method="post">
			<textarea name="post" rows="8" cols="40"></textarea>
			<input type="submit" value="Submit Post">
		</form>

		<?php
			foreach($all_messages as $msg){
		?>
			<div id="post">
				<h1> Post by <?= $msg['first_name'] . " " . $msg['last_name'] ?> </h1>
				<p> <?= $msg['post'] ?> </p>
				<?php
					foreach($msg['comments'] as $comment){
				?>
					<p id="post"> <strong><?= $comment['user'] . ": " ?></strong> <?= $comment['comment'] ?>

					<?php
						if($comment['user_id'] == $this->session->userdata['user']['id']){
					?>
						<button> <a href="<?= base_url('comments/delete_comment') . '/' . $comment['id'] ?>">DELETE</a> </button>
					<?php
						}
					 ?>
				 	</p>
				<?php
					}
			 	?>

				<form action="<?= base_url('comments/add_comment') ?>" method="post">
					<textarea name="comment" rows="3" cols="40"></textarea>
					<input type="hidden" name="message_id" value="<?= $msg['id'] ?>">
					<input type="submit" value="Submit Comment">
				</form>
				<?php
					if($msg['user_id'] == $this->session->userdata['user']['id']){
				?>
						<a href="<?= base_url('messages/delete_message') . '/' . $msg['id'] ?>">DELETE</a>
		<?php } ?>
				<p class="footer"> Written at: <?= $msg['created_at'] ?> </p>
			</div>
		<?php
			}
	  ?>
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>
</body>
</html>
