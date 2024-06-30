<?php
include '../connection.php';
session_start();
if(isset($_SESSION['email'])){
    if(isset($_POST['data'])){
        session_destroy();
        echo "ok";
    }
}
else{
    echo "<script>window.location.href = '../login';</script>";
}
?>