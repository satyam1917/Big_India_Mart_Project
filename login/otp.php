<?php
include '../connection.php';
session_start();
if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="style.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/bad18e3e79.js" crossorigin="anonymous"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .container {
            background-color: #242b35;
            max-width: 400px;
            /* Adjust width as needed */
            margin: 0 auto;
            /* Center align the container */
            padding: 20px;
            /* Add some padding for spacing */
        }

        form {
            text-align: center;
            /* Align form content to center */
        }

        .button {
            display: block;
            margin: 20px auto;
            /* Center align the button and add padding */
            width: 200px;
            /* Set the width of the button */
            padding: 10px;
            /* Add padding to the button */
        }

        label {
            display: block;
            text-align: left;
            /* Align labels to the left */
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="tel"],
        select {
            width: 100%;
            /* Make input fields take full width */
            box-sizing: border-box;
            /* Include padding and border in the width */
            margin-bottom: 10px;
            /* Add some space between fields */
            padding: 10px;
            /* Add padding inside input fields */
            border: 1px solid #ccc;
            /* Add border to input fields */
            border-radius: 4px;
            /* Add rounded corners to input fields */
        }

        h2 {
            font-family: Arial, sans-serif;
            /* Specify font family for the heading */
        }
    </style>

</head>

<body>
    <div class="container">
        <h2>OTP Verification</h2>
        <center>
            <?php
            if (isset($_POST['submit'])) {
                $otp = $_POST['otp'];
                $query = "SELECT * FROM `registration` WHERE `email`='$email' and `email_otp`='$otp'";
                $result = mysqli_query($conn, $query);
                $num_row = mysqli_num_rows($result);

                if ($num_row > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $data = $row['password'];
                    echo "<script>window.location.href = 'new-password.php?data=" . $data . "';</script>";
                } else {
                    echo "<span class='message'><i class='fa-solid fa-triangle-exclamation'></i> Enter Correct Email</span>";
                }
            }
            ?>
        </center>
        <form action="" method="post">
            <p>Note: If you do not receive any OTP, then check in spam.</p>
            <label for="otp">Enter OTP:</label>
            <input type="text" id="otp" name="otp" maxlength="4" pattern="\d{4}" required>
            <input class="button" type="submit" value="Submit" name="submit">
        </form>
    </div>
</body>

</html>