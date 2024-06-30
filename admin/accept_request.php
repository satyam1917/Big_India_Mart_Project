<?php
include '../connection.php';
session_start();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "UPDATE `services` SET `status`='Processing' WHERE `id`='$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "ok";
    } else {
        echo "Something went wrong! Try again.";
    }
} else {
    echo "<script>window.location.href = '../login/index.php';</script>";
}
