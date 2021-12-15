<?php 
include __DIR__ . '/../config/application.config.php';
$users = getAlliDs();

/*
<?php
session_start();
session_destroy();

echo "Logout.";
?> */
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<script src="javascript.js"></script>
		<div class="login">
			<button class="login-button" onclick="onClickLogin(event)">Login</button> 
			<br>
			<button class="register-button" onclick="onClickRegister(event)">Registrierung</button> 
		</div>
		Tickets
		<div id="tickets">
		<?php 
		  include "tickets.php";
		?>
		</div>
	</body>
</html>
