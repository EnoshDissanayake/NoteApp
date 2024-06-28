<?php
require "connection.php";
$registerDetails = json_decode(file_get_contents("php://input"));

$user = new stdClass();

$search_user = Database::search("SELECT * FROM `user` WHERE `mobile` = '".$registerDetails->mobile."'");
if($search_user->num_rows==1){
    $user->first_name = "Your mobile number already exists";
    echo json_encode($user);

}else{

if (empty($registerDetails->firstname)) {
    $user->first_name = "Please Enter Your First Name";
    echo json_encode($user);
}else if (empty($registerDetails->lastname)) {
    $user->first_name = "Please Enter Your Last Name";
    echo json_encode($user);
}else if(!preg_match("/^07[01245678]\d{7}+$/", $registerDetails->mobile)){
    $user->first_name = "Invalid Mobile Number";
    echo json_encode($user);
}else if (empty($registerDetails->password)) {
    $user->first_name = "Please Enter Your password";
    echo json_encode($user);
}else if (empty($registerDetails->usertype)) {
    $user->first_name = "Select Enter Your user type";
    echo json_encode($user);
}else{
    Database::iud("INSERT INTO `user`(`firstName`,`lastName`,`mobile`,`password`,`user_type_id`) VALUES ('".$registerDetails->firstname."','".$registerDetails->lastname."','".$registerDetails->mobile."','".$registerDetails->password."','".$registerDetails->usertype."')");
    // $user = new stdClass();
    $user->first_name = "success";
    echo json_encode($user); 
}


}