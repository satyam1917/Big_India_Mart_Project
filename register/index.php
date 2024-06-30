<?php
include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Big India Mart | Create Your Account</title>
  <meta name="description" content="Register with Big India Mart to create your account and access a wide range of services including education, legal, banking, insurance, rentals, shopping, construction, tour and travel, and event management. Join us today!" />
  <meta name="keywords" content="Big India Mart Registration, User Registration, Create Account, Sign Up, Service Registration" />
  <meta name="robots" content="noindex, nofollow" />
  <link rel="canonical" href="https://bigindiamart.in/register" />

  <link rel="stylesheet" href="style.css" />
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <script src="https://kit.fontawesome.com/bad18e3e79.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <h2>Sign Up</h2>
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
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // $services = $_POST['services'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];
        $state = $_POST['state'];
        if (strlen($phone) == 10) {
          if (strlen($pincode) == 6) {
            $email_otp = rand(1000, 9999);
            $phone_otp = rand(1000, 9999);

            //check user exist or not
            $sql_check = "SELECT * FROM `registration` WHERE `email`='$email'";
            $query_check = mysqli_query($conn, $sql_check);
            $num_of_row = mysqli_num_rows($query_check);
            if ($num_of_row > 0) {
              echo " <span class='message'><i class='fa-solid fa-triangle-exclamation'></i> This user aleady exist</span>";
            } else {
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
                $mail->addAddress($email, $name);     //Add a recipient
            
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
                            <p>Dear '.$name.',</p>
                            <p>Thank you for using our services. Your One-Time Password (OTP) for verification is:</p>
                            <p class="otp">'.$email_otp.'</p>
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
              //     // echo "<p>Email successfully sent to $to</p>";
              // } else {
              //     // echo "<p>Failed to send email</p>";
              // }
              $sql = "INSERT INTO `registration`(`id`, `name`, `email`, `email_otp`, `email_verify`, `phone`, `phone_otp`, `phone_verify`, `password`, `service`, `add1`, `add2`, `city`, `pincode`, `state`, `regis_amount`, `regis_payment`, `payment_id`) VALUES (null,'$name','$email','$email_otp','No','$phone','$phone_otp','No','$hashedPassword','','$address1','$address2','$city','$pincode','$state','','Not Paid','')";
              $query = mysqli_query($conn, $sql);
              $query_wallet="INSERT INTO `wallet`(`id`, `wallet_point`, `email`) VALUES (null,'0','$email')";
              $result_wallet=mysqli_query($conn,$query_wallet);
              if ($query) {
                if (isset($_GET['refer'])) {
                  $refer_email = $_GET['refer'];
                  $referamoun = 10;
                  $date = date("d/m/Y");
                  $query_for_referal = "INSERT INTO `refer_and_earn`(`id`, `email`, `refer_email`, `refer_amount`, `refer_status`, `date`) VALUES (null,'$email','$refer_email','$referamoun','No','$date')";
                  $result_for_referal = mysqli_query($conn, $query_for_referal);
                  if ($result_for_referal) {
                    echo "<script>window.location.href = 'otp.php?email=" . $email . "';</script>";
                  } else {
                    echo "<span class='message'><i class='fa-solid fa-triangle-exclamation'></i> Database Error. Try after sometime</span>";
                  }
                } else {
                  echo "<script>window.location.href = 'otp.php?email=" . $email . "';</script>";
                }
              } else {
                echo " <span class='message'><i class='fa-solid fa-triangle-exclamation'></i> Database Error. Try after sometime</span>";
              }
            }
          } else {
            echo " <span class='message'><i class='fa-solid fa-triangle-exclamation'></i> Enter correct pincode</span>";
          }
        } else {
          echo "  <span class='message'><i class='fa-solid fa-triangle-exclamation'></i> Enter correct Phone Number</span>";
        }
      }
      ?>
    </center>
    <form action="" method="post">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email address</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="phone" maxlength="10" pattern="\d{10}" required>

      <label for="address1">Address Line 1</label>
      <input type="text" id="address1" name="address1" required>

      <label for="address2">Address Line 2</label>
      <input type="text" id="address2" name="address2">

      <label for="city">City</label>
      <input type="text" id="city" name="city" required>

      <label for="pincode">Pincode</label>
      <input type="text" id="pincode" name="pincode" required maxlength="6" pattern="\d{6}">

      <label for="state">State</label>
      <select id="state" name="state" required>
        <option value="" disabled selected>Select a State</option>
        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
        <option value="Andhra Pradesh">Andhra Pradesh</option>
        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
        <option value="Assam">Assam</option>
        <option value="Bihar">Bihar</option>
        <option value="Chandigarh">Chandigarh</option>
        <option value="Chhattisgarh">Chhattisgarh</option>
        <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
        <option value="Delhi">Delhi</option>
        <option value="Goa">Goa</option>
        <option value="Gujarat">Gujarat</option>
        <option value="Haryana">Haryana</option>
        <option value="Himachal Pradesh">Himachal Pradesh</option>
        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
        <option value="Jharkhand">Jharkhand</option>
        <option value="Karnataka">Karnataka</option>
        <option value="Kerala">Kerala</option>
        <option value="Ladakh">Ladakh</option>
        <option value="Lakshadweep">Lakshadweep</option>
        <option value="Madhya Pradesh">Madhya Pradesh</option>
        <option value="Maharashtra">Maharashtra</option>
        <option value="Manipur">Manipur</option>
        <option value="Meghalaya">Meghalaya</option>
        <option value="Mizoram">Mizoram</option>
        <option value="Nagaland">Nagaland</option>
        <option value="Odisha">Odisha</option>
        <option value="Puducherry">Puducherry</option>
        <option value="Punjab">Punjab</option>
        <option value="Rajasthan">Rajasthan</option>
        <option value="Sikkim">Sikkim</option>
        <option value="Tamil Nadu">Tamil Nadu</option>
        <option value="Telangana">Telangana</option>
        <option value="Tripura">Tripura</option>
        <option value="Uttar Pradesh">Uttar Pradesh</option>
        <option value="Uttarakhand">Uttarakhand</option>
        <option value="West Bengal">West Bengal</option>

      </select>

      <input class="button" type="submit" value="Submit" name="submit" />

      <div class="new-user">
        <a href="../login/">Already a user?</a>
      </div>
    </form>
    <p style="text-align: center; font-size: 12px; margin-top: 20px">
    2024 Big India Mart. All rights reserved.
    </p>
  </div>
</body>

</html>