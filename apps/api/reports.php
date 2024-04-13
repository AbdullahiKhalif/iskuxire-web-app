<?php
//import/include conncection file
include '../config/conn.php';

//read All Reports Data
function readAllReports($conn){
    $query = "SELECT * FROM reports";
    $result = $conn->query($query);
    $data = array();
    $message = array();

    if($result) {
        while($row = $result->fetch_assoc()) {
            $data [] = $row;
        }
        $message = array("status" => true, "data" => $data);
    }else{
        $message = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($message);
}

// read specific report
function readReportInfo($conn){
    extract($_POST);
    $query = "SELECT * FROM reports WHERE report_id = '$report_id' ";;
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

// regiser Report post
function registerReport($conn){
    extract($_POST);
    $data = array();
    $error_message = array();

    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $new_id = generateReportId($conn);
    $saved_name = $new_id. ".png";

    $allowedImage = ["image/png", "image/jpeg", "image/jpg"];

    if(in_array($file_type, $allowedImage)){

        $max_size = 5 * 1024 * 1024;
        if($file_size > $max_size){
            $error_message [] = $file_size/1024/1024 . " MB File Size exceeds allowed image size ". $max_size/1024/1024;
        }
    }else{
        $error_message [] = "This File Is Not Allowed ". $file_type;
    }
    
    if(count($error_message) <= 0){
        $query = "INSERT INTO reports (report_id, user_id,description,image) VALUES ('$new_id','$user_id', '$description', '$saved_name')";
        $result = $conn->query($query);
        if($result){
            move_uploaded_file($file_tmp, "../uploads/report posts/".$saved_name);
            $data = array("status" => true, "data" => "Successfully Uploaded Report ✅");
        }else{
            $data = array("status" => false, "data" => $conn->error);
        }

    }else{
        $data = array("status" => false, "data" => $error_message);
    }


    echo json_encode($data);
}

//update user 
function updateReport($conn){
    extract($_POST);
    $data = array();
    $error_message  = array();

    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $allowedImage = ["image/png", "image/jpg", "image/jpeg"];
    $saved_name = $report_id.".png";

    if(!empty($file_tmp)){
        if(in_array($file_type, $allowedImage)){
            $max_size = 5 * 1024 * 1024;

            if($file_size > $max_size){
                $error_message [] = $file_size/1024/1024 . " MB File Size exceeds allowed size ". $max_size/1024/1024;
            }
        }else{
            $error_message [] = "This file is not allowed ". $file_type;
        }

        if(count($error_message) <= 0){
            $query = "UPDATE reports SET user_id = '$user_id', description = '$description', image ='$saved_name' WHERE report_id = '$report_id'";
        $reult = $conn->query($query);

        if($reult){
            move_uploaded_file($file_tmp, "../uploads/report posts/". $saved_name);
            $data = array("status" =>true, "data" => "Successfully updated ✔✔");
        }else{
            $data = array("status" =>false, "data" => $conn->error);
        }
        }else{
            $data = array("status" => false, "data" => $error_message);
        }

    }else{
        $query = "UPDATE reports SET user_id = '$user_id', description = '$description' WHERE report_id = '$report_id'";
        $reult = $conn->query($query);

        if($reult){
            $data = array("status" =>true, "data" => "Successfully updated ✔");
        }else{
            $data = array("status" =>false, "data" => $conn->error);
        }
    }


    echo json_encode($data);
}

//delete report 
function deleteReport($conn){
    extract($_POST);
    $query = "DELETE FROM reports WHERE report_id = '$report_id'";
    $result = $conn->query($query);
    $data = array();

    if($result){
        unlink("../uploads/report posts/".$report_id.".png");
        $data = array("status" => true, "data" => "Successfully Deleted ✔😃");
    }else{
        $data = array("status" => false, "data" => $conn-error);
    }
    echo json_encode($data);
}

#function generate reportid
function generateReportId($conn){
    $newId = '';
    $query = "SELECT * FROM reports ORDER BY report_id DESC LIMIT 1";
    $result = $conn->query($query);

    if($result){
        $num_rows = $result->num_rows;
        if($num_rows > 0){
            $row = $result->fetch_assoc();
            $newId = ++$row['report_id'];
        }else{
            $newId = 'Rep001';
        }

        return $newId;
    }
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "Action Is Required❌"));
}
?>