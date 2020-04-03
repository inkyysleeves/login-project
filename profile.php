<?php
session_start();
if (isset($_SESSION["userID"])) {
    require("./config/db.php");
    $userID = $_SESSION["userID"];
    if (isset($_POST["edit"])) {
        $userName = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
        $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
        $stmt = $pdo->prepare("UPDATE users SET name=?, email=? WHERE id=?");
        $stmt->execute([$userName, $userEmail, $userID]);
    }
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userID]);
    $user = $stmt->fetch();
}
?>
<?php require("./inc/header.html"); ?>
<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Update Your Details</div>
        <div class="card-body">
            <form action="profile.php" method="POST">
                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input type="text" name="userName" class="form-control" value="<?php echo $user->name ?>" />
                </div>
                <div class="form-group">
                    <label for="userEmail">User Email</label>
                    <input type="email" name="userEmail" class="form-control" value="<?php echo $user->email ?>" />
                    <br />
                    <?php if (isset($emailTaken)) { ?>
                        <p style="color:red; font-weight:bold;"><?php echo $emailTaken; ?></p>
                    <?php } ?>
                </div>
                <button name="edit" type="submit" class="btn btn-primary ">Update Details</button>
            </form>
        </div>
    </div>
</div>
<?php require("./inc/footer.html"); ?>






<!-- if (isset($_POST["register"])) {

$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
$passwordHashed = password_hash($password, PASSWORD_DEFAULT);

if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? ');
$stmt->execute([$userEmail]);
$totalUsers = $stmt->rowCount();

if ($totalUsers > 0) {
$emailTaken = "Email Already Registered <br>";
} else {
$stmt = $pdo->prepare('INSERT into users(name , email, password) VALUES( ? , ? , ? )');
$stmt->execute([$userName, $userEmail, $passwordHashed]);
header("location: http://localhost:8888/login-project/index.php");
}
}
} -->