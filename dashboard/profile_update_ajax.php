<?php
include '../connection.php';
session_start();
if (isset($_SESSION['email'])) {
    $field=$_POST['field'];
    $value=$_POST['data'];
    $email=$_SESSION['email'];
    if($field=="phone"){
        $query="UPDATE `registration` SET `phone`='$value' WHERE `email`='$email'";
    }elseif ($field=="add1") {
        $query="UPDATE `registration` SET `add1`='$value' WHERE `email`='$email'";
    }elseif ($field=="add2") {
        $query="UPDATE `registration` SET `add2`='$value' WHERE `email`='$email'";
    }elseif ($field=="city") {
        $query="UPDATE `registration` SET `city`='$value' WHERE `email`='$email'";
    }elseif ($field=="pincode") {
        $query="UPDATE `registration` SET `pincode`='$value' WHERE `email`='$email'";
    }elseif ($field=="state") {
        $query="UPDATE `registration` SET `state`='$value' WHERE `email`='$email'";
    }
    
    $result=mysqli_query($conn,$query);
    if($result){
        echo "ok";
    }else{
        echo "Database Error!. Try Again";
    }
}else{

}
?>