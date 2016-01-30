<?php
session_start();
if (is_null($_SESSION['mail'])) {
    header("location: index.php");
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <script src="scripts/jquery-1.11.3.min.js"></script>
        <script src="scripts/bootstrap.min.js"></script>
        <script src="scripts/script.js"></script>
        <link rel="stylesheet" href="styles/bootstrap.min.css">
        <link rel="stylesheet" href="styles/style.css">
        <meta charset="utf-8">
        <title>LAMP Task 5</title>
    </head>
    <body>
    <div class="container-fluid">
        <div class="row">
            <div class="well col-lg-12">
                <h1>LAMP Task 5</h1>
            </div>
        </div>
        <h4><label><?php if (isset($_SESSION['feedback_error'])) echo $_SESSION['feedback_error'] ?></label></h4>
        <div class="row">
            <div class="col-lg-offset-4 col-lg-4">
                <h2><label>Welcome <?php echo $_SESSION['mail']; ?></label></h2>
                <a href="logout.php">
                    <button class="btn btn-purple btn-lg top">Logout</button>
                </a>
                <h3><label>Information about your account: </label></h3>
                <?php if (isset($_SESSION['avatar'])) { ?>
                    <img src="<?php echo $_SESSION['avatar'] ?>" height="100" width="100"><br>
                <?php } ?>
                <label>Your E-mail: <?php echo $_SESSION['mail'] ?></label><br>
                <label>Your password: <?php echo $_SESSION['pass'] ?></label><br>
                <label>Your sex: <?php echo $_SESSION['sex'] ?></label><br>
                <label>Your subscribe on news?: <?php echo $_SESSION['subscribe'] ?></label>
            </div>
        </div>
        <div class="row">
            <form method="post" action="feedback_profile.php" id="form">
                <div class="col-lg-4 col-lg-offset-4">
                    <label>Text of feedback</label>
                </div>
                <div class="form-group-lg" align="center">
                        <textarea name="feedback" id="feedback" class="form-control"
                                  placeholder="Text of feedback (maximum 200 characters)" rows="3"
                                  required></textarea>
                </div>
                <label class="char" id="char"></label>
                <br>
                <input type="submit" value="Write" class="btn btn-purple btn-lg">
            </form>
        </div>
    </div>
    </body>
    </html>
<?php
if (is_null($_SESSION['remember'])) {
    session_destroy();
}
$_SESSION['feedback_error'] = null;
?>