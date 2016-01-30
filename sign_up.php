<?php
session_start();
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
        <h4><label><?php if (isset($_SESSION['reg_error'])) echo $_SESSION['reg_error'] ?></label></h4>
        <h4><label><?php if (isset($_SESSION['file_error'])) echo $_SESSION['file_error'] ?></label></h4>
        <div class="row">
            <form enctype="multipart/form-data" method="post" action="register.php" id="form">
                <div class="form-group-lg" align="center">
                    <label>E-mail</label>
                    <input type="text" class="form-control" name="mail" id="mail" placeholder="E-mail">
                </div>
                <div class="form-group-lg" align="center">
                    <label>Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                </div>
                <div class="form-group-lg" align="center">
                    <label>Sex</label>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" name="sex" value="male">
                        Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sex" value="female">
                        Female
                    </label>
                </div>
                <div class="form-group-lg" align="center">
                    <label>Subscribe on news</label>
                    <br>
                    <label class="checkbox-inline">
                        <input type="checkbox" class="subscribe" name="subscribe" value="yes">
                        Yes
                    </label>
                </div>
                <div class="form-group-lg" align="center">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5242880"/>
                    <label>Choose your avatar:</label>
                    <input name="avatar" id="avatar" class="btn btn-purple btn" type="file" required/>
                </div>
                <input type="submit" value="Sign up" class="btn btn-purple btn-lg top">
            </form>
        </div>
    </div>
    </body>
    </html>
<?php
$_SESSION['reg_error'] = null;
$_SESSION['file_error'] = null;
?>