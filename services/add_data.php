<?php
include '../connection.php';
session_start();
if (isset($_SESSION['email'])) {
    if(isset($_POST['service'])){
        $email=$_SESSION['email'];
        $date=date("d/m/Y");
        $services = $_POST['service'];
        $message=$_POST['message'];
        $query = "INSERT INTO `services`(`id`, `services`, `user`, `date`, `status`, `cashback`, `bonus`,`message`) VALUES (null,'$services','$email','$date','Request Created','0','0','$message')";
        $result=mysqli_query($conn,$query);
        if($result){
            echo "ok";
        }
        else{
            echo "Database error. Try Again!";
        }
    }
    else{
        echo "<script>window.location.href = '../login/index.php';</script>";
    }
    // $email=$_SESSION['email'];
    // if (isset($_POST['submit'])) {
    //     $date=date("d/m/Y");
    //     $services = $_POST['services'];
    //     $query = "INSERT INTO `services`(`id`, `services`, `user`, `date`, `status`, `cashback`, `bonus`) VALUES (null,'$services','$email','$date','Request Created','0','0')";
    //     $result=mysqli_query($conn,$query);
    //     if($result){
    //         echo "<script> alert('Request Created Sucessfully.'); </script>";
    //     }
    // }
} else {
    echo "logout";
}
?>