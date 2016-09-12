<html lang="en">
<head>
	<meta charset="utf-8">
	<title>The Tasks</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
<div id="container">

	<h1>Task Tracker</h1>
	<div class="margin">
		<div class="login">
			<h3>Login</h3>
			<form action="<?= base_url('loginregister/signin') ?>" method="post">
				<p> Email: <input type="text" name="email"> </p>
				<p> Password: <input type="password" name="password"> </p>
				<input type="submit" value="Login">
			</form>
		</div>

		<div class="register">
			<h3>Register</h3>
			<form action="<?= base_url('loginregister/register') ?>" method="post">
				<p> First Name: <input type="text" name="first_name"> </p>
				<p> Last Name: <input type='test' name='last_name'> </p>
				<p> Email Address: <input type='text' name='email'> </p>
				<p> Password: <input type='password' name='password'> </p>
				<p> Confirm Password: <input type='password' name='confirm_password'> </p>
				<input type='submit' value='Register'>
			</form>
		</div>
		<div id ='alerts'>
		<?php
			echo "<div id='success'>".$this->session->flashdata('success')."</div>";
			echo "<div id='error'>".$this->session->flashdata('errors')."</div>";
		?>
		</div>
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>
