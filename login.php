<?php
session_start();
$file = "data/users.json";
$mail = $_POST["mail"];
$pass = $_POST["pass"];
$remember = $_POST["remember"];
$json = file_get_contents($file);
$json_decoded = json_decode($json, true);
foreach ($json_decoded as $users => $value) {
    if (strcasecmp($value['mail'], $mail) == 0 && strcasecmp($value['pass'], $pass) == 0) {
        $_SESSION['mail'] = $mail;
        $_SESSION['pass'] = $pass;
        $_SESSION['sex'] = $value['sex'];
        $_SESSION['subscribe'] = $value['subscribe'];
        $_SESSION['avatar'] = $value['avatar'];
        $_SESSION['remember'] = $remember;
        header("location: profile.php");
        break;
    } else {
        $_SESSION['sign_error'] = 'Invalid username and/or password!';
        header("location: index.php");
    }
}