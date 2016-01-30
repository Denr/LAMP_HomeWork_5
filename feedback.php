<?php
session_start();
?>
    <html>
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
        <h4><label><?php if (isset($_SESSION['file_error'])) echo $_SESSION['file_error'] ?></label></h4>
        <div class="row">
            <form method="post" enctype="multipart/form-data" action="leave_feedback.php" id="form">
                <div class="form-group-lg" align="center">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="mail" id="mail" placeholder="E-mail" required>
                </div>
                <div class="form-group-lg" id="files_form" align="center">
                    <label>Text of feedback</label>
                <textarea name="feedback" id="feedback" class="form-control"
                          placeholder="Text of feedback (maximum 200 characters)" rows="3"
                          required></textarea>
                    <label class="char" id="char"></label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="5242880"/>
                    <br>
                    <label>Attach image:</label>
                    <input name="image[]" id="image" class="btn btn-purple btn" type="file" required/>
                </div>
                <input type="button" id="add_file" class="btn btn-purple top" value="Add another file">
                <br>
                <input type="submit" value="Write" class="btn btn-purple top btn-lg">
            </form>
        </div>
        <form method="post" action="show_feedback.php">
            <div class="row">
                <div class='col-lg-offset-4 col-lg-4'>
                    <input type="submit" value="Display all feedback" class="btn btn-purple btn-lg">
                </div>
            </div>
        </form>
    </div>
    </body>
    </html>
<?php
$_SESSION['feedback_error'] = null;
$_SESSION['file_error'] = null;
?>