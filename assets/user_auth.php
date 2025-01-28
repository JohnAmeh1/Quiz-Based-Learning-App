<?php

function getUser(){
    $userId = $_SESSION['auth'];
    $query = "SELECT * from users where user_id = '$userId' LIMIT 1";
    
    $DB = new Database();
    $result = $DB->read($query);
    if ($result){
        $user_data = $result[0];
        return $user_data;
    }
}