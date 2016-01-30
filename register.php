<?php
session_start();
$file = "data/users.json";
$mail = $_POST["mail"];
$pass = $_POST["pass"];
$sex = $_POST["sex"];
$subscribe = $_POST["subscribe"];
if (empty($subscribe)) {
    $subscribe = "no";
}
$image_dir = "avatars/";
$image_file = $image_dir . basename($_FILES['avatar']["name"]);
$path = $image_file;
$upload_status = 1;
$correct_reg = 1;
$image_type = pathinfo($image_file, PATHINFO_EXTENSION);

function validateMail($mail)
{
    return filter_var($mail, FILTER_VALIDATE_EMAIL);
}

function validatePass($pass)
{
    $upperCase = preg_match('@[A-Z]@', $pass);
    $lowerCase = preg_match('@[a-z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
    if (!$upperCase || !$lowerCase || !$number || strlen($pass) < 8) {
        if (!$upperCase) {
            $_SESSION['reg_error'] = 'Password must contain at least one uppercase character!';
        }
        if (!$lowerCase) {
            $_SESSION['reg_error'] = 'Password must contain at least one lowercase character!';
        }
        if (!$number) {
            $_SESSION['reg_error'] = 'Password must contain at least 1 number!';
        }
        if (strlen($pass) < 8) {
            $_SESSION['reg_error'] = 'Password must be a minimum of 8 characters!';
        }
        return false;
    } else {
        return true;
    }
}

if (isset($mail) && isset($pass) && isset($sex) && validateMail($mail) && validatePass($pass)) {
    $formData = array(
        "mail" => $mail,
        "pass" => $pass,
        "sex" => $sex,
        "subscribe" => $subscribe,
        "avatar" => $path
    );
    $arrayData = array();
    $json = file_get_contents($file);
    $arrayData = json_decode($json, true);
    $arrayData[] = $formData;
    $json = json_encode($arrayData, JSON_PRETTY_PRINT);
} else {
    $correct_reg = 0;
    if (!validateMail($mail) && isset($mail)) {
        $_SESSION['reg_error'] = 'Incorrect e-mail address!';
    }
    if (empty($sex)) {
        $_SESSION['reg_error'] = 'Choose your sex!';
    }
}
if ($correct_reg) {
    if ($_FILES['avatar']['size'] > 5242880 || $_FILES['avatar']['error'] == 2) {
        $upload_status = 0;
        $_SESSION['file_error'] = "Sorry, your file is too large.";
    }
    if (strcasecmp($image_type, "jpg") != 0 && strcasecmp($image_type, "jpeg") != 0 && strcasecmp($image_type, "png") != 0 && strcasecmp($image_type, "gif") != 0) {
        $upload_status = 0;
        $_SESSION['file_error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
    }
    if (file_exists($image_file)) {
        $upload_status = 0;
        $_SESSION['file_error'] = 'Sorry, the file already exists.';
    }
    if ($upload_status) {
        if (file_put_contents($file, $json) && move_uploaded_file($_FILES['avatar']['tmp_name'], $image_file)) {
            $_SESSION['sign_error'] = 'You have successfully registered!';
            header("location: index.php");
        } else {
            $_SESSION['file_error'] = "Sorry, your file has not been loaded.";
        }
    }
}
if (!$upload_status || !$correct_reg) {
    header("location: sign_up.php");
}