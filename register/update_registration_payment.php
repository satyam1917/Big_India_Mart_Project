<?php
include '../connection.php';
session_start();
if (isset($_POST['amount'])) {
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $payment_id = $_POST['paymentid'];
    $query = "UPDATE `registration` SET `regis_amount`='$amount',`regis_payment`='Paid',`payment_id`='$payment_id' WHERE `email`='$email'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $query_for_check = "SELECT * FROM `refer_and_earn` WHERE `email`='$email'";
        $result_for_check = mysqli_query($conn, $query_for_check);
        $num_row_for_check = mysqli_num_rows($result_for_check); 
        if ($num_row_for_check > 0) {
            $row=mysqli_fetch_assoc($result_for_check);
            $refer_email=$row['refer_email'];
            $query_for_refer = "UPDATE `refer_and_earn` SET `refer_status`='Yes' WHERE `email`='$email'";
            $result_for_query = mysqli_query($conn, $query_for_refer);
            $wallet_point=$wallet_point+10;
            $query_referal="UPDATE `wallet` SET `wallet_point`='$wallet_point' WHERE `email`='$refer_email'";
            $result_referal=mysqli_query($conn,$query_referal);
            if ($result_for_query) {
                $_SESSION['email'] = $email;
                echo "ok";
            } else {
                echo "Database error. try after sometime";
            }
        }
        else{
            $_SESSION['email'] = $email;
            echo "ok";
        }
    } else {
        echo "Database error. try after sometime";
    }
} else {
    echo "<script>window.location.href = 'index.php';</script>";
}
