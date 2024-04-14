<?php
session_start();
include '../config/conn.php';
header('Content-Type: application/json');

// read all trnasactions information
function readAllTransactions($conn){
    $query = "SELECT * FROM transactions";
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
// read transaction information
function readTransactionInfo($conn){
    extract($_POST);
    $query = "SELECT * FROM transactions WHERE transaction_id = '$transaction_id'";
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
//register Transaction

function registerTransaction($conn){
    extract($_POST);
    $user_id =$_SESSION['user_id'];
    $query = "INSERT INTO transactions (user_id,ficility_id, waste_id, quantity, transaction_method) VALUES('$user_id', '$ficility_id', '$waste_id', '$quantity', '$transaction_method')";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully created Transaction ✅");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

//update transaction

function updateTransaction($conn){
    extract($_POST);
    $userId =$_SESSION['user_id'];
    $query = "UPDATE transactions SET ficility_id = '$ficility_id', waste_id  = '$waste_id', quantity ='$quantity', transaction_method = '$transaction_method'  WHERE transaction_id = '$transaction_id'";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully updated Transaction ✔");
    }else{
        $data = array("status"=>false, "data" => $conn->error);
    }

    echo json_encode($data);
}

// delete transaction

function deleteTransaction($conn){
    extract($_POST);
    $query = "DELETE FROM transactions WHERE transaction_id = '$transaction_id'";
    $result = $conn->query($query);

    $data =array();

    if($result){
        $data = array("status"=>true, "data" => "Successfully deleted transaction ✅");
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