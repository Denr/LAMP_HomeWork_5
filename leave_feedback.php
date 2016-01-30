<?php
session_start();
$file = "data/users.json";
$file_feedback = "data/feedback.json";
$mail = $_POST["mail"];
$feedback = $_POST["feedback"];
$feedback = str_replace("\r\n", "<br>", $feedback);
$line_number = 1;
$image_dir = "images/";
$path = "";
for ($i = 0; $i < count($_FILES["image"]["name"]); $i++) {
    $image = $image_dir . basename($_FILES["image"]["name"][$i]);
    $path = $path . "<a href='" . $image . "'>" . $image . "</a>; ";
}
$upload_status = 1;
$correct_mail = 0;

$json = file_get_contents($file);
$file = new SplFileObject("data/users.json");
foreach ($file as $line) {
    $position = strripos($line, $mail);
    if ($position === false) {
        $count++;
    } else {
        break;
    }
}
$json_decoded = json_decode($json, true);
$formData = array(
    "id" => $count + 1,
    "feedback" => $feedback,
    "images" => $path
);
$arrayData = array();
if (file_exists($file_feedback)) {
    $jsonFeed = file_get_contents($file_feedback);
    $arrayData = json_decode($jsonFeed, true);
}
$arrayData[] = $formData;
$jsonFeed = json_encode($arrayData, JSON_PRETTY_PRINT);
foreach ($json_decoded as $users => $value) {
    if (strcasecmp($value['mail'], $mail) == 0) {
        $correct_mail = 1;
        break;
    } else {
        if (isset($mail)) {
            $correct_mail = 0;
            $_SESSION['feedback_error'] = "Wrong E-mail!";
            $_SESSION['file_error'] = "Sorry, your file has not been loaded.";
        }
    }
}
if ($correct_mail) {
    for ($i = 0; $i < count($_FILES["image"]["name"]); $i++) {
        $image_file = $image_dir . basename($_FILES["image"]["name"][$i]);
        $image_type = pathinfo($image_file, PATHINFO_EXTENSION);
        if ($_FILES['image']['size'][$i] > 5242880 || $_FILES['image']['error'][$i] == 2) {
            $upload_status = 0;
            $_SESSION['file_error'] = "Sorry, your file is too large.";
        }
        if (strcasecmp($image_type, "jpg") != 0 && strcasecmp($image_type, "jpeg") != 0 && strcasecmp($image_type, "png") != 0 && strcasecmp($image_type, "gif") != 0) {
            $upload_status = 0;
            $_SESSION['file_error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        }
        if (file_exists($image_file)) {
            $upload_status = 0;
            $_SESSION['file_error'] = 'Sorry, file already exists.';
        }
        if ($upload_status != 0) {
            if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $image_file) && file_put_contents($file_feedback, $jsonFeed)) {
                $_SESSION['feedback_error'] = "Reviewed by!";
                $_SESSION['file_error'] = 'The file ' . basename($_FILES["image"]["name"]) . ' has been uploaded.';
            } else {
                $_SESSION['file_error'] = "Sorry, your file has not been loaded.";
            }
        }
    }
}
header("location: feedback.php");