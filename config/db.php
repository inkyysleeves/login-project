<?php 
$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'login-project';
//set dsn = Databse Source Name
$dsn = 'mysql:host=' . $host .'; dbname=' . $dbname;
try {
  //created a PDO instance 
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "connected succesfully";
} catch(PDOException $e) {
  echo "Connection Failed: " . $e->getMessage();
}
?>