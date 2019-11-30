<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
	<div class="login-page">
	<div class="form">
		<h1>Sell or Buy Items</h1>
		<form class="register-form" action="registration.php" method="POST">
			<?php include('errors.php'); ?>
			<input type="text" name="email" placeholder="email"/>
			<input type="text" name="password" placeholder="password"/>
			<input type="text" name="street" placeholder="street"/>
			<input type="text" name="city" placeholder="city"/>
			<input type="text" name="state" placeholder="state"/>
			<input type="text" name="zipcode" placeholder="zip code"/>
			<input type="text" name="phone" placeholder="phone number (enter only digits)"/>
			<button type="submit" name="send">Create Account</button>
			<p class="message">Already Registered? <a href="login.php">Login</a></p>
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
