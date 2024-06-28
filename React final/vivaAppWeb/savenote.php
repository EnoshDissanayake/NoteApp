<?php
require "connection.php";
$loginDetails = json_decode(file_get_contents("php://input"));

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `note`(`title`,`description`,`category_id`,`user_id`,`date`) VALUES ('".$loginDetails->title."','".$loginDetails->description."','".$loginDetails->category_id."','".$loginDetails->user_id."','".$date."')");
$user = new stdClass();
    $user->first_name = "success";
    echo json_encode($user);
?>