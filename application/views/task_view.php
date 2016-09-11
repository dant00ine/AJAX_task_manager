<html>
<head>
	<title>Task Manager</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<script type="text/javascript" src = "/assets/jquery-2.1.4.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			$.get("/todos/generate_todos", function(res){

				console.log(res.todos);
				console.log(res.complete_todos);

				for(var i = 0; i < res.todos.length; i++){
          			$(".col-md-4").append("<div class =\'col-md-1\'><p>"
								+res.todos[i].when_at + res.todos[i].title+
								" Completed? " + res.todos[i].completed + "</p></div>");
          		}

				for(var i = 0; i < res.complete_todos.length; i++){
          			$(".col-md-4").append("<div class =\'col-md-1\'><p>"
								+res.complete_todos[i].when_at + res.compelte_todos[i].title+
								" Completed? " +res.complete_todos[i].completed+"</p></div>");
          		}

			}, 'json');

			$('#newTodo').submit(function(){
				console.log('form submit in ajax');
				$.post('/todos/add_todo', $(this).serialize(), function(event){
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
		<h1>todo list
			<a style="float: right; font-size: 12;" href="<?= base_url('loginregister/logout') ?>">Logout</a>
		</h1>
		<h3 style = "padding-left: 10px;">Hello, <?= $user['first_name'] ?>. Keep track of your tasks here!</h3>


		<form id = "newTodo">
			<input name="title" type="text"></input>
			<input name="when_at" type="date"></input>
			<input type="submit" value="Submit Todo">
		</form>

		<div class="col-md-4">
			<p> Incomplete Tasks </p>
		</div>

		<div class="col-md-5">
			<p> Complete Tasks </p>
		</div>

		<form>
			<input type="hidden" name="name" value="res.todos.id">
			<input type="checkbox">
		</form>


		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>
</body>
</html>
