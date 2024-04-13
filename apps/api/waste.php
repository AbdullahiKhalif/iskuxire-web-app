<?php

include '../config/conn.php';
header('Content-Type: application/json');

// read all waste information
function readAllWaste($conn){
    $query = "SELECT * FROM waste";
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
// read water information
function readWasteInfo($conn){
    extract($_POST);
    $query = "SELECT * FROM waste WHERE waste_id = '$waste_id'";
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
//register waste

function registerWaste($conn){
    extract($_POST);
    $query = "INSERT INTO Waste (description,category_id, address, weight, user_id) VALUES('$description', '$category_id', '$address', '$weight', '$user_id')";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully created waste ✅");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

//update waste

function updateWaste($conn){
    extract($_POST);
    $query = "UPDATE waste SET description =  '$description' , category_id = '$category_id', address  = '$address', weight = '$weight', user_id ='$user_id' WHERE waste_id = '$waste_id'";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully updated waste ✔");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

// delete waste

function deleteWaste($conn){
    extract($_POST);
    $query = "DELETE FROM waste WHERE waste_id = '$waste_id";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully deleted waste ✅");
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