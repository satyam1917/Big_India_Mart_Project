<?php
include '../connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Big India Mart | Access Your Account</title>
  <meta name="description" content="Login to Big India Mart to access your account and manage your services, track orders, and more. Secure and easy login for all users." />
  <meta name="keywords" content="Big India Mart Login, User Login, Account Access, Service Management, Secure Login" />
  <meta name="robots" content="noindex, nofollow" />
  <link rel="canonical" href="https://bigindiamart.in/login" />

  <link rel="stylesheet" href="style.css" />
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://kit.fontawesome.com/bad18e3e79.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <h2>Sign in</h2>
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
        $password = $_POST['password'];
        if ($email == "admin@gmail.com" and $password == "admin") {
          $_SESSION['admin'] = $email;
          echo "<script>window.location.href = '../admin/index.php';</script>";
        } else {
          $query_for_pass = "SELECT * FROM `registration` WHERE `email`='$email'";
          $result_for_pass = mysqli_query($conn, $query_for_pass);
          $num_row_for_pass = mysqli_num_rows($result_for_pass);
          if ($num_row_for_pass > 0) {
            $row = mysqli_fetch_assoc($result_for_pass);
            $verify = password_verify($password, $row['password']);
            if ($verify == 1) {
              $query_for_OTP_verify = "SELECT * FROM `registration` WHERE `email`='$email' and `email_verify`='Yes'";
              $result_for_OTP_verify = mysqli_query($conn, $query_for_OTP_verify);
              $num_row_for_OTP_verify = mysqli_num_rows($result_for_OTP_verify);
              if ($num_row_for_OTP_verify > 0) {
                $query_for_payment_verify = "SELECT * FROM `registration` WHERE `email`='$email' and `regis_payment`='Paid'";
                $result_for_payment_verify = mysqli_query($conn, $query_for_payment_verify);
                $num_row_for_payment_verify = mysqli_num_rows($result_for_payment_verify);
                if ($num_row_for_payment_verify > 0) {
                  $_SESSION['email'] = $email;
                  echo "<script>window.location.href = '../dashboard/index.php';</script>";
                } else {
                  echo '<script>var options = {
                                        "key": "rzp_test_nCdl84G8xQKpgR",
                                        "amount": "1000",
                                        "currency": "INR",
                                        "name": "Big India Mart",
                                        "prefill.email": "user_email@gmail.com",
                                        "prefill.contact": 1234567890,
                                        "prefill.name": "user_name",
                                        "description": "BIG INDIA MART",
                                        "image": "",
                                        "theme.color": "#01204E",
                                        "handler": function (response) {
                                            console.log(response);
                                            jQuery.ajax({
                                                url: "../Register/update_registration_payment.php",
                                                type: "POST",
                                                data: {
                                                    email:"' . $email . '",
                                                    paymentid: response.razorpay_payment_id,
                                                    amount: "10"
                                                },
                                                success: function (result) {
                                                    if (result == "ok") {
                                                        window.location.href = "../dashboard/index.php";
                                                    }
                                                    else {
                                                        alert(result);
                                                    }
                        
                                                }
                                            });
                                        }
                                    };
                                    var rzp1 = new Razorpay(options);
                                    rzp1.open();</script>';
                }
              } else {
                $email_otp = rand(1000, 9999);

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
                    <title>Big India Mart OTP Verification</title>
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
                            <h2>OTP Verification</h2>
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

                // if (mail($to, $subject, $message, $headers)) {
                //   // echo "<p>Email successfully sent to $to</p>";
                // } else {
                //   // echo "<p>Failed to send email</p>";
                // }
                $query_for_update_OTP = "UPDATE `registration` SET `email_otp`='$email_otp' WHERE `email`='$email'";
                $result_for_update_OTP = mysqli_query($conn, $query_for_update_OTP);
                if ($result_for_update_OTP) {
                  echo "<script>window.location.href = '../register/otp.php?email=" . $email . "';</script>";
                } else {
                  echo "<span class='message'><i class='fa-solid fa-triangle-exclamation'></i> Database Error. Try after sometime</span>";
                }
              }
            } else {
              echo "<span class='message'><i class='fa-solid fa-triangle-exclamation'></i> Enter Correct Password</span>";
            }
          } else {
            echo "<span class='message'><i class='fa-solid fa-triangle-exclamation'></i> Enter Correct Email</span>";
          }
        }
      }
      ?>
    </center>
    <form action="" method="post">
      <label for="email">Email address</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <div class="forgot-password">
        <a href="forget-password.php">Forget password?</a>
      </div>

      <input class="button" type="submit" value="Submit" name="submit">

      <div class="new-user">
        <a href="../register/index.php">New user ?</a>
      </div>
    </form>
    <p style="text-align: center; font-size: 12px; margin-top: 20px">
    2024 Big India Mart. All rights reserved.
    </p>
  </div>

</body>

</html>