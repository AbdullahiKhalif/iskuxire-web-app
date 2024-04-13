<?php
session_start();
include '../config/conn.php';
header('Content-Type: application/json');

function getTotalUsers($conn){
    $data = array();
    $message = array();
    $query = "SELECT COUNT(*) 'total' FROM category";
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
function getTotalCategories($conn){
    $data = array();
    $message = array();
    $query = "SELECT COUNT(*) 'total' FROM category";
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
function getTotalWaste($conn){
    $data = array();
    $message = array();
    $query = "SELECT COUNT(*) 'total' FROM waste";
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
function getTotalLocation($conn){
    $data = array();
    $message = array();
    $query = "SELECT COUNT(*) 'total' FROM location";
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
function getTotalRecycle($conn){
    $data = array();
    $message = array();
    $query = "SELECT COUNT(*) 'total' FROM recycling_ficilities";
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

function getTotalTransactions($conn){
    $data = array();
    $message = array();
    $query = "SELECT COUNT(*) 'total' FROM transactions";
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


function getTotalReport($conn){
    $data = array();
    $message = array();
    $query = "SELECT COUNT(*) 'total' FROM reports";
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
function getTotalSchedule($conn){
    $data = array();
    $message = array();
    $query = "SELECT COUNT(*) 'total' FROM schedule";
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

function getScheduleTable($conn){
    $data = array();
    $message = array();
    $query = "SELECT S.schedule_id, R.ficility_name AS facility_name, S.days_of_week, S.start_date, S.end_date
    FROM Schedule AS S
    JOIN recycling_ficilities AS R ON S.ficility_id = R.ficility_id;
    ";
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
if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "Action Is Required!"));
}
?>