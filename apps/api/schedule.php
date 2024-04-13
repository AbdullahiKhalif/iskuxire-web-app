<?php

include '../config/conn.php';
header('Content-Type: application/json');

// read all schedule information
function readAllSchedule($conn){
    $query = "SELECT * FROM schedule";
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
// read schedule information
function readScheduleInfo($conn){
    extract($_POST);
    $query = "SELECT * FROM schedule WHERE schedule_id = '$schedule_id'";
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
//register schedule

function registerSchedule($conn){
    extract($_POST);
    $query = "INSERT INTO Schedule (ficility_id,days_of_week, start_date, end_date) VALUES('$ficility_id', '$days_of_week', '$start_date', '$end_date')";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully created schedule ✅");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

//update schedule

function updateSchedule($conn){
    extract($_POST);
    $query = "UPDATE schedule SET ficility_id =  '$ficility_id' , days_of_week = '$days_of_week', start_date  = '$start_date', end_date = '$end_date' WHERE schedule_id = '$schedule_id'";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully updated schedule ✔");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

// delete schedule

function deleteSchedule($conn){
    extract($_POST);
    $query = "DELETE FROM schedule WHERE schedule_id = '$schedule_id";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully deleted schedule ✅");
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