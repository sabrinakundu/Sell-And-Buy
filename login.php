<?php include('serverlogin.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
	<div class="login-page">
	<div class="form">
		<h1>Sell or Buy Items</h1>
		<form class="login-form" action="login.php" method="POST">
			<?php include('errors.php'); ?>
			<input type="text" name="email" placeholder="email"/>
			<input type="text" name="password" placeholder="password"/>
			<button type="submit" name="send">Login</button>
			<p class="message">Not Registered? <a href="registration.php">Register</a></p>
		</form>

	</div>
	</div>

	<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>

	<script>
		$('.message a').click(function(){
			$('form').animate({height: "toggle", opacity: "toggle"});
		});
	</script>
</body>
</html>
