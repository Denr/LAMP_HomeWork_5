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
</div>
<?php
$file = "data/feedback.json";
$users = "data/users.json";
$lines = file($users);
$json = file_get_contents($file);
$json_decoded = json_decode($json, true);
$output_table = "<table class=\"table table-hover\" align=\"center\">
                    <thead align=\"center\">
                            <tr>
                                <td>#</td>
                                <td>E-mail</td>
                                <td>Feedback</td>
                                <td>Images</td>
                            </tr>
                    </thead>
                    <tbody align=\"center\">";
$count = 1;
foreach ($json_decoded as $feedback => $value) {
    $id = $value['id'] - 1;
    $mail = str_replace("\"", "", $lines[$id]);
    $mail = str_replace("mail:", "", $mail);
    $mail = str_replace(",", "", $mail);
    $feedback = $value['feedback'];
    $images = $value['images'];
    $output_table .= "<tr><td>$count</td><td>$mail</td><td>$feedback</td><td>$images</td></tr>";
    $count++;
}
$output_table .= "</tbody>
                    </table>";
echo $output_table;
?>
</body>
</html>