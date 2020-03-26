<?php 
session_start();
if(isset($_SESSION["userID"])){
    session_destroy();
    header("location: http://localhost:8888/login-project/index.php");
}
?>