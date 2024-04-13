<?php
include '../config/conn.php';
header('Content-Type: application/json');

// read all users information
function readAllUsers($conn){
    $query = "SELECT * FROM users";
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

// register user
function registerUser($conn) {
    extract($_POST);
    $errorMessage = array();
    $data = array();

    #files
    $fileName = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];
    $fileTempName = $_FILES['image']['tmp_name'];

    $newId = generateUserId($conn);
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
    $checkUsername = "SELECT * FROM users WHERE username = '$username'";
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $checkPhone = "SELECT * FROM users WHERE phone = '$phone'";
    $checkResultUsername = $conn->query($checkUsername);
    $checkResultEmail = $conn->query($checkEmail);
    $checkResultPhone = $conn->query($checkPhone);

    if ($checkResultUsername->num_rows > 0) {
        $data = array("status" => false, "data" => "Username is already taken");
    }
    else if ($checkResultEmail->num_rows > 0) {
        $data = array("status" => false, "data" => "Email is already taken");
    }
    else if ($checkResultPhone->num_rows > 0) {
        $data = array("status" => false, "data" => "Phone is already taken");
    } else {
        $query = "INSERT INTO users (user_id, username, email, password, phone, role, image, status) VALUES ('$newId', '$username', '$email', MD5('$password'), '$phone', '$role', '$savedName', '$status')";

        $result = $conn->query($query);

        if ($result) {
            $data = array("status" => true, "data" => "Successfully Registered ✔");
            move_uploaded_file($fileTempName, "../uploads/users/".$savedName);
        } else {
            $data = array("status" => false, "data" => $conn->error);
        }
    }

    } else {
        $data = array("status" => false, "data" => $errorMessage);
    }
    echo json_encode($data);
}

#update User
function updateUser($conn) {
    extract($_POST);
    $errorMessage = array();
    $data = array();

    #files
    $fileName = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];
    $fileTempName = $_FILES['image']['tmp_name'];

    $newId = generateUserId($conn);
    $savedName = $user_id . ".png";

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
        $checkUsername = "SELECT * FROM users WHERE username = '$username' AND user_id != '$user_id'";
        $checkEmail = "SELECT * FROM users WHERE email = '$email' AND user_id != '$user_id'";
        $checkPhone = "SELECT * FROM users WHERE phone = '$phone' AND user_id != '$user_id'";
        $checkResultUsername = $conn->query($checkUsername);
        $checkResultEmail = $conn->query($checkEmail);
        $checkResultPhone = $conn->query($checkPhone);
    
        if ($checkResultUsername->num_rows > 0) {
            $data = array("status" => false, "data" => "Username is already taken");
        }
        else if ($checkResultEmail->num_rows > 0) {
            $data = array("status" => false, "data" => "Email is already taken");
        }
        else if ($checkResultPhone->num_rows > 0) {
            $data = array("status" => false, "data" => "Phone is already taken");
        } else {
            $query = "UPDATE users SET username = '$username', email = '$email', password = MD5('$password'), phone = '$phone', role = '$role', image = '$savedName', status = '$status' WHERE user_id = '$user_id'";
    
            $result = $conn->query($query);
    
            if ($result) {
                $data = array("status" => true, "data" => "Successfully Updated ✔✔");
                move_uploaded_file($fileTempName, "../uploads/users/".$savedName);
            } else {
                $data = array("status" => false, "data" => $conn->error);
            }
        }
    } else {
        $data = array("status" => false, "data" => $errorMessage);
        }
    }else{
                // Continue with the update logic
        $checkPhone = "SELECT * FROM users WHERE phone = '$phone' AND user_id != '$user_id'";
        $checkResultPhone = $conn->query($checkPhone);

        if ($checkResultPhone->num_rows > 0) {
            $data = array("status" => false, "data" => "Phone Is Already Exists");
        } else {
            $checkUsername = "SELECT * FROM users WHERE username = '$username' AND user_id != '$user_id'";
            $checkEmail = "SELECT * FROM users WHERE email = '$email' AND user_id != '$user_id'";
            $checkPhone = "SELECT * FROM users WHERE phone = '$phone' AND user_id != '$user_id'";
            $checkResultUsername = $conn->query($checkUsername);
            $checkResultEmail = $conn->query($checkEmail);
            $checkResultPhone = $conn->query($checkPhone);
        
            if ($checkResultUsername->num_rows > 0) {
                $data = array("status" => false, "data" => "Username is already taken");
            }
            else if ($checkResultEmail->num_rows > 0) {
                $data = array("status" => false, "data" => "Email is already taken");
            }
            else if ($checkResultPhone->num_rows > 0) {
                $data = array("status" => false, "data" => "Phone is already taken");
            } else {
                $query = "UPDATE users sET username = '$username', email = '$email', password = MD5('$password'), phone = '$phone', role = '$role', status = '$status' WHERE user_id = '$user_id'";
        
                $result = $conn->query($query);
        
                if ($result) {
                    $data = array("status" => true, "data" => "Successfully Updated ✔");
                    move_uploaded_file($fileTempName, "../uploads/users/".$savedName);
                } else {
                    $data = array("status" => false, "data" => $conn->error);
                }
            }
        }
    }

    
    echo json_encode($data);
}


# delete user
function deleteUser($conn){
    extract($_POST);
    $query = "DELETE FROM users WHERE user_id = '$user_id'";
    $result = $conn->query($query);
    $data = array();

    if($result) {
        unlink('../uploads/users/'. $user_id.".png");
        $data = array("status" => true, "data" => "Successfully Deleted ✔😃");
    }else{
           // Other database error
           $data = array("status" => false, "data" => $conn->error);
    }
    echo json_encode($data);
}


#function generate User Id
function generateUserId($conn){
    $newId = '';
    $query = "SELECT * FROM users ORDER BY user_id DESC LIMIT 1";
    $result = $conn->query($query);

    if($result){
        $num_rows = $result->num_rows;
        if($num_rows > 0){
            $row = $result->fetch_assoc();
            $newId = ++$row['user_id'];
        }else{
            $newId = 'USR001';
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