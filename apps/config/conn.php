<?php
$conn = new mysqli("localhost","root","", "iskuxire");
if($conn->connect_error) {
    echo $conn->error;
}
?>