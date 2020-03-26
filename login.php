<?php
session_start();
if (isset($_POST["login"])) {
    require("./config/db.php");
    $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? ");
    $stmt->execute([$userEmail]);
    $user = $stmt->fetch();
    if (isset($user)) {
        if (password_verify($password, $user->password)) {
            echo "The password is correct";
            $_SESSION["userID"] = $user -> id;
            header("location: http://localhost:8888/login-project/index.php");
        } else {
            // echo "The login email or passsword is incorrect";
            $wrongLogin = "The login email or passsword is incorrect";
        }
    }
}
?>
<?php require("./inc/header.html"); ?>
<div class="container">
    <div class="card">
        <div class="card-header bg-light mb-3">Login</div>
        <div class="card-body">
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="userEmail">User Email</label>
                    <input type="email" name="userEmail" class="form-control" />
                    <br />
                    <?php if (isset($wrongLogin)) { ?>
                        <p style="color:red; font-weight:bold;"><?php echo $wrongLogin; ?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="password">User Password</label>
                    <input type="password" name="password" class="form-control" />
                </div>
                <button name="login" type="submit" class="btn btn-primary ">Login</button>
            </form>
        </div>
    </div>
</div>
<?php require("./inc/footer.html"); ?>