<?php
require "connection.php";
$loginDetails = json_decode(file_get_contents("php://input"));

// echo $loginDetails->username;



$search_user = Database::search("SELECT * FROM `user` WHERE `mobile` = '".$loginDetails->username."' AND `password` = '".$loginDetails->password."'");
if($search_user->num_rows==1){

    $exsist_user = $search_user->fetch_assoc();

    $usey_type_search = Database::search("SELECT * FROM `user_type` WHERE `id` = '".$exsist_user["user_type_id"]."'");
    $user_type = $usey_type_search->fetch_assoc();
    
    $user = new stdClass();
    $user->id = $exsist_user["id"];
    $user->first_name = $exsist_user["firstName"];
    $user->last_name = $exsist_user["lastName"];
    $user->mobile = $exsist_user["mobile"];
    $user->password = $exsist_user["password"];
    $user->type = $user_type["type"];
    
    echo json_encode($user);

}else{
    $user = new stdClass();
    $user->first_name = "nope";
    echo json_encode($user);
    
}

?>