<html>
<head>
	<title>tasks tracker</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">

	<script type="text/javascript" src = "/assets/jquery-2.1.4.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){

			var id = $('#username').text();

			var get_todos = function(){
				$.get("/todos/generate_todos/" + id, function(res){
					for(var i = 0; i < res.todos.length; i++){
									$(".incomplete").append("<div class =\'col-md-1\'><p>"
									+res.todos[i].when_at + ": <strong>" + res.todos[i].title+ "</strong></p>"
									+ "<form id = \'update_status/"+res.todos[i].id + "\'>"
										+ "<input type=\'hidden\' name=\'todo_id\' value=\'" + res.todos[i].id + "\'>"
										+ "<input type=\'hidden\' name=\'completed\' value=\'" + res.todos[i].completed + "\'>"
										+ "Completed? <input id=\'check\' type=\'checkbox\'>"
									+ "</form>"

									+ "</div>");
								}


					for(var i = 0; i < res.complete_todos.length; i++){
									$(".complete").append("<div class =\'col-md-1\'><p>"
									+res.complete_todos[i].when_at + ": "  +"<strong>"+ res.complete_todos[i].title+"</strong></p>"
									+ "<form id = \'update_status/"+res.complete_todos[i].id + "\'>"
										+ "<input type=\'hidden\' name=\'todo_id\' value=\'" + res.complete_todos[i].id + "\'>"
										+ "<input type=\'hidden\' name=\'completed\' value=\'" + res.complete_todos[i].completed + "\'>"
										+ "Incomplete? <input id=\'check\' type=\'checkbox\' value=\'c\' checked>"
									+ "</form>"

									+ "</div>");
								}

				}, 'json');
			}

			get_todos();

			$('#newTodo').submit(function(){
				$.post('/todos/add_todo', $(this).serialize(), function(event){
					// event.preventDefault();
				}, 'json');
			});

			$('body').on('change', 'input#check', function(){
				var route = $(this.form).attr('id');
				var data = $(this.form).serialize();
				$.post('/todos/'+route, data, function(event){

					$('.incomplete').empty();
					$('.complete').empty();

					get_todos();

				}, 'json');
			});

		});

	</script>
</head>
<body>
	<div id="container">
		<?php
			$user = $this->session->userdata['user'];
		 ?>
		<h1>Task Tracker
			<a style="float: right; font-size: 12;" href="<?= base_url('loginregister/logout') ?>">Logout</a>
		</h1>
		<h3 style = "padding-left: 10px;">Hello, <?= $user['first_name'] ?><span style="display: none;" id="username"><?= $user['id'] ?></span>. Keep track of your tasks here!</h3>

		<form id = "newTodo">
			<input name="title" type="text"></input>
			<input name="when_at" type="date"></input>
			<input type="submit" value="Submit Todo">
		</form>


		<div id="container" class="list">
			<p> Incomplete Tasks </p>
			<div class="incomplete">

			</div>
		</div>


		<div id="container" class="list">
			<p> Complete Tasks </p>
			<div class="complete">

			</div>
		</div>


		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>
</body>
</html>
