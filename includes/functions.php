<?php 
require_once __DIR__ . '/../config/application.config.php';


function connectToDatabase(): PDO {
   $dbData = getDatabaseConfig();
    
    $dsn = 'mysql:host='.$dbData['host'].';port='.$dbData['port'].';dbname='.$dbData['dbname'].';charset=utf8';
    
    
    return new PDO(
        $dsn,
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
        ); 
}

function updateEmail ($email) {
    
    var_dump($email);
    $pdo = connectToDatabase();
        
        $statement = $pdo->prepare("UPDATE verwaltung SET email = :email where verwaltungID = 3");
        $statement -> bindParam(':email', $email);
        $statement->execute();
        
        if($statement) {
            echo 'Registrierung Erfolgreich. Hier könnte eine Weiterleitung kommen';
        } else {
            echo 'Fehler.';
        }
    
}

function getAlliDs() {
    
    $pdo = connectToDatabase();
    
    try {
        $users = [];
        $dbresult = $pdo->query('select verwaltungID from verwaltung', PDO::FETCH_ASSOC);
        
        foreach ($dbresult as $userRow) {
            $userRow = $userRow["verwaltungID"];
            $users[] = $userRow;
        }

        return $users;
    } catch (PDOException $e) {
        return [];
    }
}

function logInUser($email, $passwort, $loginTyp) {
    
    $pdo = connectToDatabase();
    
    $statement = $pdo->prepare("select * from ". $loginTyp ." where email = :email");
    $statement -> bindParam(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
    if ($user !== false && password_verify($passwort, $user['passwort'])){
        session_start();
        $_SESSION['userid'] = $user[$loginTyp.'ID'];
        echo('Login erfolgreich. Hier könnte eine Weiterleitung kommen');
    } else {
        $errorMessage = "E-Mail oder Passwort ungültig!";
    }
}

function registerUser ($email, $passwort, $regTyp) {
    
    $error = false;
    $pdo = connectToDatabase();
    
    $statement = $pdo->prepare("SELECT * FROM ". $regTyp ." WHERE email = :email");
    $statement -> bindParam(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
    if($user !== false) {
        echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
        $error = true;
    }
    
    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO ". $regTyp ." (email, passwort) VALUES (:email, :passwort)");
        $statement -> bindParam(':email', $email);
        $statement -> bindParam(':passwort', $passwort_hash);
        $statement->execute();
        
        if($statement) {
            echo 'Registrierung Erfolgreich. Hier könnte eine Weiterleitung kommen';
        } else {
            echo 'Fehler.';
        }
    } 
    
}

function redirectTo(string $destination) {
    header('Location: ' . $destination);
    exit();
}

function getDatabaseConfig() {
    
    global $CONFIG;
    
    return [
        'host' => $CONFIG['database']['host'],
        'port' => $CONFIG['database']['port'],
        'dbname' => $CONFIG['database']['dbname']
    ];
}


?>