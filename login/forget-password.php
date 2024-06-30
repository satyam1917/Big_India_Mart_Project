<?php
include '../connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
        <h2>Forget Password</h2>
        <center>
            <?php

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

            //Load Composer's autoloader
            require '../phpmailer/vendor/autoload.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $query = "SELECT * FROM `registration` WHERE `email`='$email'";
                $result = mysqli_query($conn, $query);
                $email_otp = rand(1000, 9999);
                $num_row = mysqli_num_rows($result);
                if ($num_row > 0) {
                    $query_for_otp_update = "UPDATE `registration` SET `email_otp`='$email_otp' WHERE `email`='$email'";
                    $result_for_otp_update = mysqli_query($conn, $query_for_otp_update);
                    if ($result_for_otp_update) {
                        $row=mysqli_fetch_assoc($result);
                        //otp send code
                        try {
                            //Server settings
                            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'admin_email@gmail.com';                     //SMTP username
                            $mail->Password   = 'SMTP_password';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                            //Recipients
                            $mail->setFrom('admin_email@gmail.com', 'Big India Mart');
                            $mail->addAddress($email, $row['name']);     //Add a recipient

                            // //Attachments
                            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Big India Mart OTP Verification';
                            $mail->Body    = '<!DOCTYPE html>
                  <html lang="en">
                  <head>
                      <meta charset="UTF-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <title>Big India Mart Forget Password OTP Verification</title>
                      <style>
                          body {
                              font-family: Arial, sans-serif;
                              background-color: #f4f4f4;
                              margin: 0;
                              padding: 0;
                              color: #333;
                          }
                          .container {
                              max-width: 600px;
                              margin: 0 auto;
                              background-color: #ffffff;
                              padding: 20px;
                              border-radius: 8px;
                              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                          }
                          .header {
                              text-align: center;
                              padding: 10px 0;
                              background-color: #242b35;
                              color: white;
                              border-radius: 8px 8px 0 0;
                          }
                          .header h1 {
                              margin: 0;
                          }
                          .content {
                              padding: 20px;
                              text-align: center;
                          }
                          .otp {
                              font-size: 24px;
                              font-weight: bold;
                              color: #4CAF50;
                              margin: 20px 0;
                          }
                          .footer {
                              text-align: center;
                              padding: 10px 0;
                              font-size: 12px;
                              color: #777;
                              border-top: 1px solid #ddd;
                              margin-top: 20px;
                          }
                      </style>
                  </head>
                  <body>
                      <div class="container">
                          <div class="header">
                              <img src="https://sangeetmusicplayer.000webhostapp.com/logo.png" alt="Big India Mart Logo">
                          </div>
                          <div class="content">
                              <h2>Forget Password OTP Verification</h2>
                              <p>Dear ' . $row['name'] . ',</p>
                              <p>Thank you for using our services. Your One-Time Password (OTP) for verification is:</p>
                              <p class="otp">' . $email_otp . '</p>
                              <p>Please enter this OTP to complete your verification process. The OTP is valid for 10 minutes.</p>
                              <p>If you did not request this OTP, please ignore this email or contact our support team.</p>
                              <p>Thank you,<br>Big India Mart Team</p>
                          </div>
                          <div class="footer">
                              <p>&copy; 2024 Big India Mart. All rights reserved.</p>
                          </div>
                      </div>
                  </body>
                  </html>';

                            $mail->send();
                            // echo 'Message has been sent';
                        } catch (Exception $e) {
                            echo "<span class='message'><i class='fa-solid fa-triangle-exclamation'></i> Error: OTP not send</span>";
                        }
                        echo "<script>window.location.href = 'otp.php?email=" . $email . "';</script>";
                    } else {
                        echo "<span class='message'><i class='fa-solid fa-triangle-exclamation'> Database Error! Try agmain</i></span>";
                    }
                } else {
                    echo "<span class='message'><i class='fa-solid fa-triangle-exclamation'> </i> Enter Correct Email</span>";
                }
            }

            ?>
        </center>
        <form action="" method="post">
            <label for="email">Enter Email:</label>
            <input type="email" id="email" name="email" required>

            <input class="button" type="submit" value="Submit" name="submit">
        </form>
    </div>
</body>

</html>