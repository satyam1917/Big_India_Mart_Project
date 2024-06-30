<?php
include 'connection.php';
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if(isset($_POST['submit'])){
  $email=$_POST['email'];
  $name=$_POST['name'];
  $message=$_POST['message'];

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
    $mail->setFrom('admin_email@gmail.com', $name.'Big India Mart');
    $mail->addAddress('admin_email@gmail.com', $name);     //Add a recipient

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Message from Big India Mart home Page.';
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
                <h4>Name: '.$name.'</h4>
                <h4>Name: '.$email.'</h4>
                <p>'.$message.'</p>
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Big India Mart - Comprehensive Services for Education, Legal, Banking, Insurance, Rentals, Shopping & More</title>
  <meta name="description" content="Big India Mart offers a wide range of services including Educational, Legal, Banking, Insurance, House Rent, Grocery, Shopping, Construction, Civil Construction, Tour and Travel, and Event Management. Your one-stop solution for all essential services in India." />
  <meta name="keywords" content="Educational Services, Legal Services, Banking Services, Insurance Services, House Rent Services, Grocery, Shopping, Daily Needs, Construction Material Supply, Civil Construction Services, Tour and Travels, Event Management, Big India Mart" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://bigindiamart.in/" />
  <link rel="stylesheet" href="homepage.css" />
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" /> -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://kit.fontawesome.com/bad18e3e79.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
  <!-- Header Section -->
  <header>
    <div class="logo">
      <img src="logo.png" alt="Logo">
    </div>
    <button id="menu-toggle" class="menu-toggle">☰</button>
    <nav id="drawer-menu" class="drawer-menu">
      <button id="close-drawer" class="close-drawer">&times;</button>
      <ul>
        <li><a href="index.php" class="active"><i class="fa-solid fa-house"></i> Home</a></li>
        <li><a href="about-us/"><i class="fa-solid fa-address-card"></i> About Us</a></li>
        <li><a href="services/"><i class="fa-solid fa-gear"></i> Services</a></li>
        <li><a href="contact-us/"><i class="fa-solid fa-phone"></i> Contact Us</a></li>
        <?php
        if (isset($_SESSION['email'])) {
          $email=$_SESSION['email'];
          $query_service="SELECT * FROM `wallet` WHERE `email`='$email'";
          $result_service=mysqli_query($conn,$query_service);
          $cashbackAndBonus=mysqli_fetch_assoc($result_service)['wallet_point'];
          
          echo '<li class="wallet-item"><a href="#"><i class="fa-solid fa-wallet"></i> Wallet <span class="wallet-point">'.$cashbackAndBonus.'</span></a></li>';
          echo '<li><a href="dashboard/index.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>';
        }
        if (isset($_SESSION['email'])) {
          echo '<li><a href="#" onclick="logout()"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>';
        } else {
          echo '<li><a href="login/index.php"><i class="fa-solid fa-right-from-bracket"></i> Login</a></li>';
        }
        ?>
      </ul>
    </nav>
  </header>
  <!-- Hero Section -->
  <main>
    <section class="hero">
      <div class="hero-overlay"></div>
      <div class="hero-content" id="hero_content">
        <h1>Welcome to Our Services</h1>
        <p>Providing top-notch Legal, Educational, Banking services,etc.</p>
        <a href="register/index.php" class="call-action-btn">Register Now</a>
      </div>
    </section>
    
    <!-- Services Section -->

    <section class="services" id="services">
      <h2>Our Services</h2>
      <ul id="service_item">
        <li id="service-id"><a href="services/index.php?serviceId=1">Educational Services</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=2">Legal Services</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=3">Banking Services</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=4">Insurance Services</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=5">House Rent Services</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=6">Grocery</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=7">Shopping</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=8">Daily Needs</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=9">Construction Material Supply Services</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=10">Civil Construction Services</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=11">Tour And Travels</a></li>
        <li id="service-id"><a href="services/index.php?serviceId=12">Event Management</a></li>
      </ul>
    </section>
    <!-- Contact Us Section -->
    <section class="contact-us-sec">
      <center>
        <h1 class="contect-title">Contact Us</h1>
      </center>
      <div class="container">

        <div class="contact-info" id="contact_info">
          <p>Not sure what you need? The team at Square Events will be happy to listen to you and suggest event ideas you hadn't considered.</p>
          <ul>
            <li>Email: admin_email@gmail.com</li>
            <li>Support: 1234567890</li> <!-- admin's phone -->
          </ul>
        </div>
        <div class="contact-form" id="contact_form">
          <h2>We'd love to hear from you! Let's get in touch</h2>
          <form action="#" method="POST">
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="message">Your Message</label>
              <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" name="submit" class="send">Send Message</button>
          </form>
        </div>
      </div>
    </section>
    <!-- Footer Section -->
    <footer>
      <div class="footer-container" id="footer_container">
        <div class="footer-about">
          <h3>About Us</h3>
          <p>Welcome to Big India Mart, your one-stop destination for comprehensive services across banking, education, legal, and more. Our mission is to provide top-quality assistance to meet all your needs, ensuring convenience and efficiency in every interaction.</p>
        </div>
        <div class="footer-links">
          <h3>Important Links</h3>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about-us/">About Us</a></li>
            <li><a href="services/">Services</a></li>
            <li><a href="contact-us/">Contact</a></li>
          </ul>
        </div>
        <div class="footer-social">
          <h3>Contact Us</h3>
          <ul class="social-icon">
            <li>Email: admin_email@gmail.com</li>
            <li>Support: 1234567890</li> <!-- admin's phone -->
          </ul>
        </div>
      </div>
    </footer>
    <div class="footer-bottom">
        <p>2024 Big India Mart. All rights reserved.</p>
      </div>
  </main>

  <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="homepage.js"></script>
  <script>
    //animation
    document.addEventListener('DOMContentLoaded', function() {
      // target_hero_content the element you want to animate
      const target_hero_content = document.getElementById('hero_content');

      // Create an intersection observer_hero_content
      const observer_hero_content = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            // Add the animation class from Animate.css
            target_hero_content.classList.add('animate__animated', 'animate__fadeInDown'); // Change 'fadeIn' to any animation you like
            // Optionally, stop observing once the animation has been added
            observer_hero_content.unobserve(target_hero_content);
          }
        });
      });

      // Start observing the target_hero_content element
      observer_hero_content.observe(target_hero_content);


      // Target the element you want to animate
      const target_service_item = document.getElementById('service_item');

      // Create an intersection observer
      const observer_service_item = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            // Add the animation class from Animate.css
            target_service_item.classList.add('animate__animated', 'animate__bounce'); // Change 'fadeIn' to any animation you like
            // Optionally, stop observing once the animation has been added
            observer_service_item.unobserve(target_service_item);
          }
        });
      });

      // Start observing the target element
      observer_service_item.observe(target_service_item);

      // Target the element you want to animate
      const target_contact_info = document.getElementById('contact_info');

      // Create an intersection observer
      const observer_contact_info = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            // Add the animation class from Animate.css
            target_contact_info.classList.add('animate__animated', 'animate__slideInLeft'); // Change 'fadeIn' to any animation you like
            // Optionally, stop observing once the animation has been added
            observer_contact_info.unobserve(target_contact_info);
          }
        });
      });

      // Start observing the target element
      observer_contact_info.observe(target_contact_info);


      // Target the element you want to animate
      const target_contact_form = document.getElementById('contact_form');

      // Create an intersection observer
      const observer_contact_form = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            // Add the animation class from Animate.css
            target_contact_form.classList.add('animate__animated', 'animate__slideInRight'); // Change 'fadeIn' to any animation you like
            // Optionally, stop observing once the animation has been added
            observer_contact_form.unobserve(target_contact_form);
          }
        });
      });

      // Start observing the target element
      observer_contact_form.observe(target_contact_form);

      // Target the element you want to animate
      const target_review_div = document.getElementById('footer_container');

      // Create an intersection observer
      const observer_review_div = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            // Add the animation class from Animate.css
            target_review_div.classList.add('animate__animated', 'animate__slideInUp'); // Change 'fadeIn' to any animation you like
            // Optionally, stop observing once the animation has been added
            observer_review_div.unobserve(target_review_div);
          }
        });
      });

      // Start observing the target element
      observer_review_div.observe(target_review_div);
    });

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

    function logout() {
      jQuery.ajax({
        url: "logout/index.php",
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
  </script>
</body>

</html>