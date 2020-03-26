<?php
session_start();
if (isset($_SESSION["userID"])) {
    require("./config/db.php");
    $userID = $_SESSION["userID"]; //gives you the users ID
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userID]);
    $user = $stmt->fetch();
    if ($user->role === "guest") {
        $message = "your role is guest";
    }
}
?>
<?php require("./inc/header.html"); ?>
<div class="container">
    <div class="card bg-light mb-3">
        <div class="card-header">
            <?php if (isset($user)) { ?>
                <h5>Welcome <?php echo $user->name ?></h5>
            <?php } else { ?>
                <h5>Welcome Guest</h5>
            <?php } ?>
        </div>
        <div class="card-body">

            <?php if (isset($user)) { ?>
                <h5>this is secret content only for logged in people</h5>
            <?php } else { ?>
                <h4>Please Login/Register to unlock all content</h4>
            <?php } ?>
        </div>
    </div>
</div>
<?php require("./inc/footer.html"); ?>