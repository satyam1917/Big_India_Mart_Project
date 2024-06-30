<?php
include '../connection.php';
session_start();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $email=$_POST['email'];
    $cashback_point=$_POST['cashback'];
    $bonus_point=$_POST['bonus'];
    $total=$cashback_point+$bonus_point;
    $query = "UPDATE `services` SET `status`='Closed',`cashback`='$cashback_point',`bonus`='$bonus_point' WHERE `id`='$id'";
    $result = mysqli_query($conn, $query);
    $query_get="SELECT * FROM `wallet` WHERE `email`='$email'";
    $result_get=mysqli_query($conn,$query_get);
    $wallet_point=mysqli_fetch_assoc($result_get)['wallet_point'];
    $total=$wallet_point+$total;
    $query_wallet="UPDATE `wallet` SET `wallet_point`='$total' WHERE `email`='$email'";
    $result_wallet=mysqli_query($conn,$query_wallet);
    if ($result) {
        echo "ok";
    } else {
        echo "Something went wrong! Try again.";
    }
} else {
    echo "<script>window.location.href = '../lgoin/index.php';</script>";
}
