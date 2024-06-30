<?php
include '../connection.php';
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../phpmailer/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];

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
        $mail->setFrom('admin_email@gmail.com', $name . 'Big India Mart');
        $mail->addAddress('admin_email@gmail.com', $name);     //Add a recipient

        // //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
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
                <h4>Name: ' . $name . '</h4>
                <h4>Name: ' . $email . '</h4>
                <h4>Subject: ' . $subject . '</h4>
                <p>' . $message . '</p>
            </div>
            <div class="footer">
                <p>&copy; 2024 Big India Mart. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>';

        $mail->send();
        echo '<script>alert("Message send successfully.");</script>';
    } catch (Exception $e) {
        echo "<script> alert('Message not send due to technical issue.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bad18e3e79.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Contact Us - Big India Mart | Get in Touch with Our Service Experts</title>
    <meta name="description" content="Contact Big India Mart for any inquiries or support regarding our wide range of services including education, legal, banking, insurance, rentals, shopping, construction, tour and travel, and event management. We're here to help!" />
    <meta name="keywords" content="Contact Big India Mart, Service Inquiries, Customer Support, Education Services, Legal Services, Banking Services, Insurance Services, House Rent Services, Grocery Shopping, Construction Services, Tour and Travel, Event Management" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://bigindiamart.in/contact-us" />

</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="../logo.png" alt="Logo">
        </div>
        <button id="menu-toggle" class="menu-toggle">☰</button>
        <nav id="drawer-menu" class="drawer-menu">
            <button id="close-drawer" class="close-drawer">&times;</button>
            <ul>
                <li><a href="../index.php"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="../about-us/"><i class="fa-solid fa-address-card"></i> About Us</a></li>
                <li><a href="../services/"><i class="fa-solid fa-gear"></i> Services</a></li>
                <li><a href="../contact-us/" class="active"><i class="fa-solid fa-phone"></i> Contact Us</a></li>
                <?php
                if (isset($_SESSION['email'])) {
                    $email = $_SESSION['email'];
                    $query_service = "SELECT * FROM `wallet` WHERE `email`='$email'";
                    $result_service = mysqli_query($conn, $query_service);
                    $cashbackAndBonus = mysqli_fetch_assoc($result_service)['wallet_point'];
                    echo '<li class="wallet-item"><a href="#"><i class="fa-solid fa-wallet"></i> Wallet <span class="wallet-point">' . $cashbackAndBonus . '</span></a></li>';
                    echo '<li><a href="../dashboard/index.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>';
                }
                if (isset($_SESSION['email'])) {
                    echo '<li><a href="#" onclick="logout()"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>';
                } else {
                    echo '<li><a href="../login/index.php"><i class="fa-solid fa-right-from-bracket"></i> Login</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
        <section class="contact-us-sec">
            <div class="container">
                <div class="contact-info">
                    <h1>Contact Information</h1>
                    <p><strong>Email:</strong> admin_email@gmail.com</p>
                    <p><strong>Mobile:</strong> 1234567890</p>  <!-- admin's phone number -->
                    <p><strong>Address:</strong> Admin's address</p>
                </div>
                <div class="contact-form">
                    <h1>Contact Us</h1>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button class="sub-btn" type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>

        <footer>
            <div class="footer-container" id="footer_container">
                <div class="footer-about">
                    <h3>About Us</h3>
                    <p>Welcome to Big India Mart, your one-stop destination for comprehensive services across banking, education, legal, and more. Our mission is to provide top-quality assistance to meet all your needs, ensuring convenience and efficiency in every interaction.</p>
                </div>
                <div class="footer-links">
                    <h3>Important Links</h3>
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../about-us/">About Us</a></li>
                        <li><a href="../services/">Services</a></li>
                        <li><a href="../contact-us/">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <h3>Contact Us</h3>
                    <ul class="social-icon">
                        <li>Email: admin_email@gmail.com</li>
                        <li>Support: 1234567890</li> <!-- admin's phone number -->
                    </ul>
                </div>
            </div>
        </footer>
        <div class="footer-bottom">
            <p>2024 Big India Mart. All rights reserved.</p>
        </div>
    </main>

    <script>
        function logout() {
            jQuery.ajax({
                url: "../logout/index.php",
                type: "POST",
                data: {
                    data: "logout"
                },
                success: function(result) {
                    if (result == "ok") {
                        window.location.href = "index.php";
                    } else {
                        alert(result);
                    }

                }
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const closeDrawer = document.getElementById('close-drawer');
            const drawerMenu = document.getElementById('drawer-menu');
            const mainContent = document.querySelector('main');

            menuToggle.addEventListener('click', function() {
                drawerMenu.classList.toggle('open');
                mainContent.classList.toggle('drawer-open');
            });

            closeDrawer.addEventListener('click', function() {
                drawerMenu.classList.remove('open');
                mainContent.classList.remove('drawer-open');
            });
        });
    </script>
</body>

</html>