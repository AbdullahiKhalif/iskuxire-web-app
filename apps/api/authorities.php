<?php
session_start();
include '../config/conn.php';
header('Content-Type: application/json');

function getSystemAuthorties($conn){
    $data = array();
    $message = array();
    $query = "SELECT * FROM systemauthview";
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $data [] = $row;
        }
        $message = array("status" => true, "data" => $data);
    }else{
        $message = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($message);
};
function getUserMenus($conn){
    $userId =$_SESSION['user_id'];
    extract($_POST);
    $data = array();
    $message = array();
    $query = "CALL getuserMenu('$userId')";
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $data [] = $row;
        }
        $message = array("status" => true, "data" => $data);
    }else{
        $message = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($message);
};
function getUserAuthorties($conn){
    extract($_POST);
    $data = array();
    $message = array();
    $query = "CALL getUserAuthority('$userId')";
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $data [] = $row;
        }
        $message = array("status" => true, "data" => $data);
    }else{
        $message = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($message);
};
function authorizeUser($conn) {
    extract($_POST);
    $data = array();
    $successData = array();
    $errorData = array();
    $deleteQuery = "DELETE FROM user_authority WHERE userId = '$userId'";
    $conn = new mysqli("localhost","root","", "iskuxire");
    $delRes = $conn->query($deleteQuery);
    if($delRes){
        for($i=0; $i < count($action_id); $i++){
            $query = "INSERT INTO user_authority (userId, action) VALUES ('$userId', '$action_id[$i]')";
            $result = $conn->query($query);

            if($result){
                $successData [] = array("status" => true, "data" => "Successfully Authorized ✔");
            }else{
                $errorData [] = array("status" => false, "data" => $conn->error);
            }
        }
    }else{
        $errorData [] = array("status" => false, "data" => $conn->error);
    }

    if(count($successData) > 0 && count($errorData) == 0){
        $data = array("status" => true, "data" => $successData);
    }elseif(count($successData) > 0){
        $data = array("status" => false, "data" => $errorData);
    }

    if(count($errorData) > 0 && count($successData) == 0){
        $data = array("status" => false, "data" => $errorData);
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