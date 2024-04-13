<?php
session_start();
include ('../config/conn.php');
header('Content-Type: application/json');

function loginUser($conn){
    extract($_POST);
    $data = array();
    $query = "CALL loginUserSp('$username', '$password')";
    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();

        if(isset($row['message'])){
            if($row['message'] == 'Deny') {
                $data = array("status" => false, "data" => "Username or password incorrect!");
            }else{
                $data = array("status" => false, "data" => "This User is blocked by admin!");
            }
        }else{
            foreach($row as $key => $value){
                $_SESSION[$key] = $value;
            }
            $data = array("status" => true, "data" => "Successfully Login.");
        }


    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "Action Is Required!"));
}
?>