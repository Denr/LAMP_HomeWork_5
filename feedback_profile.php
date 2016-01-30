<?php
session_start();
$file_feedback = "data/feedback.json";
$mail = $_SESSION['mail'];
$feedback = $_POST["feedback"];
$feedback = str_replace("\r\n", "<br>", $feedback);
$line_number = 1;
if (is_null($feedback)) {
    $_SESSION['feedback_error'] = "";
}
$file = new SplFileObject("data/users.json");
foreach ($file as $line) {
    $position = strripos($line, $mail);
    if ($position === false) {
        $count++;
    } else {
        break;
    }
}
$formData = array(
    "id" => $count + 1,
    "feedback" => $feedback
);
$arrayData = array();
if (file_exists($file_feedback)) {
    $jsonFeed = file_get_contents($file_feedback);
    $arrayData = json_decode($jsonFeed, true);
}
$arrayData[] = $formData;
$jsonFeed = json_encode($arrayData, JSON_PRETTY_PRINT);
if (file_put_contents($file_feedback, $jsonFeed)) {
    $_SESSION['feedback_error'] = "Reviewed by!";
    header("location: profile.php");
} else {
    $_SESSION['feedback_error'] = "Error!";
    header("location: profile.php");
}