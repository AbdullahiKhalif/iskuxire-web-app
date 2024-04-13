<?php

include '../config/conn.php';
header('Content-Type: application/json');

// read all location information
function readAllLocation($conn){
    $query = "SELECT * FROM location";
    $result = $conn->query($query);
    $data = array();
    $message = array();

    if($result){
        while($row = $result->fetch_assoc()){
            $data [] = $row;
        }

        $message = array("status" => true, "data" => $data);
    }else{
        $message = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($message);
    
}
// read location information
function readLocationInfo($conn){
    extract($_POST);
    $query = "SELECT * FROM location WHERE location_id = '$location_id'";
    $result = $conn->query($query);
    $data = array();
    $message = array();

    if($result){
        while($row = $result->fetch_assoc()){
            $data [] = $row;
        }

        $message = array("status" => true, "data" => $data);
    }else{
        $message = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($message);
    
}
//register location

function registerLocation($conn){
    extract($_POST);
    $query = "INSERT INTO location (district,village, zone) VALUES('$district', '$village', '$zone')";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully created location ✅");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

//update location

function updateLocation($conn){
    extract($_POST);
    $query = "UPDATE location SET district =  '$district' , village = '$village', zone = '$zone' WHERE location_id = '$location_id'";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully updated location ✔");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

// delete location

function deleteLocation($conn){
    extract($_POST);
    $query = "DELETE FROM location WHERE location_id = '$location_id";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully deleted location ✅");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "Action is Required"));
}
?>