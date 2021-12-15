<?php 
include __DIR__ . '/../config/application.config.php';

if(isset($errorMessage)) {
    echo $errorMessage;
}


if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $iban = $_POST['iban'];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    
    if(!$error) {
        $email = $_POST['email'];
        $passwort = $_POST['passwort'];
        $loginTyp = 'verwaltung';
        registerUser($email, $passwort, $loginTyp);
    }
}
?>

<html>
	<body>
		<a href="login.php">Zum Login</a>
		<br>
		<a href="index.php">Zum Start</a>
		<br>
		Registrierung
		<form action="?register=1" method="post">
			E-Mail:<br>
			<input type="email" size="40" maxlength="250" name="email"><br><br>
			Passwort:<br>
			<input type="password" size="40"  maxlength="250" name="passwort"><br> 
			Passwort wiederholen:<br>
			<input type="password" size="40" maxlength="250" name="passwort2"><br><br>
			IBAN:<br>
			<input size="40" maxlength="250" name="iban"><br><br>
			<input type="submit" value="Abschicken">
		</form>
	</body>
</html>