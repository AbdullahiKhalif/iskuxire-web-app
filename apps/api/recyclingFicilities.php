<?php

include '../config/conn.php';
header('Content-Type: application/json');

// read all recycling_ficilities information
function readAllRecycle($conn){
    $query = "SELECT * FROM recycling_ficilities";
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
function readRecycleInfo($conn){
    extract($_POST);
    $query = "SELECT * FROM recycling_ficilities WHERE ficility_id = '$ficility_id'";
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
//register recycling_ficilities

function registerRecycle($conn) {
    extract($_POST);
    $errorMessage = array();
    $data = array();

    #files
    $fileName = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];
    $fileTempName = $_FILES['image']['tmp_name'];

    $newId = generateFicilityId($conn);
    $savedName = $newId . ".png";

    $allowedImages = ["image/png", "image/jpg", "image/jpeg"];

    if (in_array($fileType, $allowedImages)) {
        $maxSize = 5 * 1024 * 1024;
        if ($fileSize > $maxSize) {
            $errorMessage[] = "File size " . $fileSize / 1024 / 1024 . " MB exceeds allowed size " . $maxSize / 1024 / 1024 . " MB";
        }
    } else {
        $errorMessage[] = "This File Type is not allowed " . $fileType;
    }

    if (count($errorMessage) <= 0) {
    $checkFicilityName = "SELECT * FROM recycling_ficilities WHERE ficility_name = '$ficility_name'";
    $checkEmail = "SELECT * FROM recycling_ficilities WHERE email = '$email'";
    $checkPhone = "SELECT * FROM recycling_ficilities WHERE phone_no = '$phone_no'";
    $checkResultFicilityName = $conn->query($checkFicilityName);
    $checkResultEmail = $conn->query($checkEmail);
    $checkResultPhone = $conn->query($checkPhone);

    if ($checkResultFicilityName->num_rows > 0) {
        $data = array("status" => false, "data" => "This Recycle Organization is already Exists");
    }
    else if ($checkResultEmail->num_rows > 0) {
        $data = array("status" => false, "data" => "Email is already taken");
    }
    else if ($checkResultPhone->num_rows > 0) {
        $data = array("status" => false, "data" => "Phone is already taken");
    } else {
        $query = "INSERT INTO recycling_ficilities (ficility_id,ficility_name, logo, description, location_id, phone_no, email) VALUES('$newId','$ficility_name', '$savedName' ,'$description', '$location_id', '$phone_no', '$email')";
        $result = $conn->query($query);

        if($result){
            $data = array("status"=>true, "data" => "Successfully created Recyle Ficility ✅");
            move_uploaded_file($fileTempName, "../uploads/logoes/".$savedName);
        }else{
            $data = array("status"=>false, "data" => $conn->error);
        }   
    }

    } else {
        $data = array("status" => false, "data" => $errorMessage);
    }
    echo json_encode($data);
}

//update recycling_ficilities

function updateRecycle($conn){
    extract($_POST);
    $errorMessage = array();
    $data = array();

    #files
    $fileName = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];
    $fileTempName = $_FILES['image']['tmp_name'];

    $newId = generateFicilityId($conn);
    $savedName = $ficility_id . ".png";

    $allowedImages = ["image/png", "image/jpg", "image/jpeg"];

    if(!empty($fileTempName)){
        if (in_array($fileType, $allowedImages)) {
            $maxSize = 5 * 1024 * 1024;
            if ($fileSize > $maxSize) {
                $errorMessage[] = "File size " . $fileSize / 1024 / 1024 . " MB exceeds allowed size " . $maxSize / 1024 / 1024 . " MB";
            }
        } else {
            $errorMessage[] = "This File Type is not allowed " . $fileType;
        }



    if (count($errorMessage) <= 0) {
        $checkFicilityName = "SELECT * FROM recycling_ficilities WHERE ficility_name = '$ficility_name' AND ficility_id != '$ficility_id'";
        $checkEmail = "SELECT * FROM recycling_ficilities WHERE email = '$email' AND ficility_id != '$ficility_id'";
        $checkPhone = "SELECT * FROM recycling_ficilities WHERE phone_no = '$phone_no' AND ficility_id != '$ficility_id'";
        $checkResultFicilityName = $conn->query($checkFicilityName);
        $checkResultEmail = $conn->query($checkEmail);
        $checkResultPhone = $conn->query($checkPhone);
    
        if ($checkResultFicilityName->num_rows > 0) {
            $data = array("status" => false, "data" => "This Recycle Ficility is already Exists");
        }
        else if ($checkResultEmail->num_rows > 0) {
            $data = array("status" => false, "data" => "Email is already taken");
        }
        else if ($checkResultPhone->num_rows > 0) {
            $data = array("status" => false, "data" => "Phone is already taken");
        } else {
            $query = "UPDATE recycling_ficilities SET  ficility_name =  '$ficility_name', logo = '$savedName' , description = '$description', location_id = '$location_id', phone_no ='$phone_no', email = '$email' WHERE ficility_id = '$ficility_id'";
    
            $result = $conn->query($query);
    
            if ($result) {
                $data = array("status" => true, "data" => "Successfully Updated Recycle Ficility ✔✔");
                move_uploaded_file($fileTempName, "../uploads/logoes/".$savedName);
            } else {
                $data = array("status" => false, "data" => $conn->error);
            }
        }
    } else {
        $data = array("status" => false, "data" => $errorMessage);
        }
    }else{
                // Continue with the update logic
        $checkPhone = "SELECT * FROM recycling_ficilities WHERE phone_no = '$phone_no' AND ficility_id != '$ficility_id'";
        $checkResultPhone = $conn->query($checkPhone);

        if ($checkResultPhone->num_rows > 0) {
            $data = array("status" => false, "data" => "Phone Is Already Exists");
        } else {
            $checkFicilityName = "SELECT * FROM recycling_ficilities WHERE ficility_name = '$ficility_name' AND ficility_id != '$ficility_id'";
            $checkEmail = "SELECT * FROM recycling_ficilities WHERE email = '$email' AND ficility_id != '$ficility_id'";
            $checkPhone = "SELECT * FROM recycling_ficilities WHERE phone_no = '$phone_no' AND ficility_id != '$ficility_id'";
            $checkResultFicilityName = $conn->query($checkFicilityName);
            $checkResultEmail = $conn->query($checkEmail);
            $checkResultPhone = $conn->query($checkPhone);
        
            if ($checkResultFicilityName->num_rows > 0) {
                $data = array("status" => false, "data" => "Username is already taken");
            }
            else if ($checkResultEmail->num_rows > 0) {
                $data = array("status" => false, "data" => "Email is already taken");
            }
            else if ($checkResultPhone->num_rows > 0) {
                $data = array("status" => false, "data" => "Phone is already taken");
            } else {
                $query = "UPDATE recycling_ficilities SET  ficility_name =  '$ficility_name' , description = '$description', location_id = '$location_id', phone_no ='$phone_no', email = '$email' WHERE ficility_id = '$ficility_id'";
        
                $result = $conn->query($query);
        
                if ($result) {
                    $data = array("status" => true, "data" => "Successfully Updated Recycle Ficility✔");
                    move_uploaded_file($fileTempName, "../uploads/logoes/".$savedName);
                } else {
                    $data = array("status" => false, "data" => $conn->error);
                }
            }
        }
    }

    
    echo json_encode($data);
}


// delete recycling_ficilities
function deleteRecycle($conn){
    extract($_POST);
    $query = "DELETE FROM recycling_ficilities WHERE ficility_id = '$ficility_id'";
    $result = $conn->query($query);
    $data = array();

    if($result) {
        unlink('../uploads/logoes/'. $ficility_id.".png");
        $data = array("status" => true, "data" => "Successfully Deleted ✔😃");
    }else{
           // Other database error
           $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}




#function generate ficility_id
function generateFicilityId($conn){
    $newId = '';
    $query = "SELECT * FROM recycling_ficilities ORDER BY ficility_id DESC LIMIT 1";
    $result = $conn->query($query);

    if($result){
        $num_rows = $result->num_rows;
        if($num_rows > 0){
            $row = $result->fetch_assoc();
            $newId = ++$row['ficility_id'];
        }else{
            $newId = 'RF_001';
        }

        return $newId;
    }
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "Action is Required"));
}
?>