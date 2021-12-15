<?php 
include __DIR__ . '/../config/application.config.php';

if(isset($_GET['login'])){
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    
    if($_GET['login'] === 1) {
        $loginTyp = 'eigentuemer';
    } else {
        $loginTyp = 'verwaltung';
    }
    logInUser($email, $passwort, $loginTyp);;
}
?>

<html>
	<body>
		<a href="register.php">Zur Registrierung</a>
		<br>
		<a href="index.php">Zum Start</a>
		<br>
		<form action="?login=1" method="post">
			E-Mail:<br>
			<input type="email" size="40" maxlength="250" name="email"><br><br>
			Passwort:<br>
			<input type="password" size="40"  maxlength="250" name="passwort"><br>
			<input type="submit" value="Abschicken">
		</form> 
		Verwaltung
		<form action="?login=2" method="post">
			E-Mail:<br>
			<input type="email" size="40" maxlength="250" name="email"><br><br>
			Passwort:<br>
			<input type="password" size="40"  maxlength="250" name="passwort"><br>
			<input type="submit" value="Abschicken">
		</form>
	</body>
</html>
