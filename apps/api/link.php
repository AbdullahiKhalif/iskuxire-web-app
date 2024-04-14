<?php
include '../config/conn.php';
header('Content-Type: application/json');

function getAllLinkFile($conn){
    $data = array();
    $arrayData = array();
    $searchResult  = glob("../views/*.php");
    foreach($searchResult as $search){
        $pureLinks = explode("/",$search);
        $arrayData [] = $pureLinks[2];
    }

    if(count($searchResult) > 0){
        $data = array("status" => true, "data" => $arrayData);
    }else{
        $data = array("status" => false, "data" => "No data available");
    }
    echo json_encode($data);
}
// get All 
function getAllLink($conn){
    $data = array();
    $message = array();
    $query = "SELECT * FROM links";
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
}

// get link Info
function getLinkInfo($conn){
    extract($_POST);
    $data = array();
    $message = array();
    $query = "SELECT * FROM links WHERE id = '$id'";
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
}
// regsister link
function registerLink($conn){
    extract($_POST);
    $data = array();
    $query = "INSERT INTO links (linkName, link, categoryId) VALUES ('$linkName', '$link', '$categoryId') ";
    $result = $conn->query($query);
    
    if($result){
        $data = array("status" => true, "data" => "Successfully Registered ✔");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

// regsister link
function updateLink($conn){
    extract($_POST);
    $data = array();
    $query = "UPDATE links SET linkName = '$linkName', link =  '$link', categoryId = '$categoryId' WHERE id = '$id'";
    $result = $conn->query($query);
    
    if($result){
        $data = array("status" => true, "data" => "Successfully Updated ✔");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}

//delete user
function deleteLink($conn) {
    extract($_POST);
    $data = array();
    $query = "DELETE FROM links WHERE id = '$id'";
    $result = $conn->query($query);
        if($result){
            $data = array("status" => true, "data" => "Successfully Deleted ✔");
        }else{
                // Other database error
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