<?php
session_start();
if (isset($_SESSION['mail'])) {
    header("location: profile.php");
}
?>
    <html>
    <head>
        <script src="scripts/jquery-1.11.3.min.js"></script>
        <script src="scripts/bootstrap.min.js"></script>
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
        <h4><label><?php if (isset($_SESSION['sign_error'])) echo $_SESSION['sign_error'] ?></label></h4>
        <div class="row">
            <form method="post" action="login.php" id="form">
                <div class="form-group-lg" align="center">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="mail" id="mail" placeholder="E-mail" required>
                </div>
                <div class="form-group-lg" align="center">
                    <label>Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                </div>
                <div class="form-group-lg" align="center">
                    <label>Remember me</label>
                    <br>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="subscribe" name="remember" value="yes">
                        Yes
                    </label>
                </div>
                <input type="submit" value="Sign in" class="btn btn-purple btn-lg top">
            </form>
        </div>
        <div class="row">
            <h3><label>No account yet?</label></h3>
            <a href="sign_up.php"><input type="button" value="Sign up" class="btn btn-purple btn-lg"></a>
        </div>
        <div class="row">
            <h3><label>Or maybe</label></h3>
            <form method="post" action="show_users.php">
                <div class='col-lg-offset-4 col-lg-4'>
                    <input type="submit" value="Display all users" class="btn btn-purple btn-lg">
                </div>
            </form>
        </div>
        <div class="row">
            <form method="post" action="feedback.php">
                <div class='col-lg-offset-4 col-lg-4'>
                    <input type="submit" value="Leave feedback" class="btn btn-purple btn-lg top">
                </div>
            </form>
        </div>
    </div>
    </body>
    </html>
<?php
$_SESSION['sign_error'] = null;
?>