<?php

include '../config/conn.php';
header('Content-Type: application/json');

// read all users information
function readAllCategories($conn){
    $query = "SELECT * FROM category";
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
// read catagory information
function readCategoryInfo($conn){
    extract($_POST);
    $query = "SELECT * FROM category WHERE id = '$id'";
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
// read catagory information
function readCategoryAvailable($conn){
    extract($_POST);
    $query = "SELECT * FROM category WHERE status = 'available'";
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
//register category

function registerCategory($conn){
    extract($_POST);
    $query = "INSERT INTO category (category_name,status, date) VALUES('$category_name', '$status', '$date')";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully created category ✅");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

//update category

function updateCategory($conn){
    extract($_POST);
    $query = "UPDATE category SET category_name =  '$category_name' , status = '$status', date = '$date' WHERE id = '$id'";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully updated category ✔");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

// delete category

function deleteCategory($conn){
    extract($_POST);
    $query = "DELETE FROM category WHERE id = '$id";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully deleted category ✅");
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