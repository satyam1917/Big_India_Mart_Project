<?php
include '../connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bad18e3e79.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>About Us - Big India Mart | Your Trusted Service Provider in India</title>
    <meta name="description" content="Learn about Big India Mart, your trusted provider of comprehensive services including education, legal, banking, insurance, rentals, shopping, construction, civil construction, tour and travel, and event management. Discover our mission and values." />
    <meta name="keywords" content="About Big India Mart, Service Provider India, Education Services, Legal Services, Banking Services, Insurance Services, House Rent Services, Grocery Shopping, Construction Services, Tour and Travel, Event Management" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://bigindiamart.in/about-us" />
    
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
                <li><a href="../about-us/" class="active"><i class="fa-solid fa-address-card"></i> About Us</a></li>
                <li><a href="../services/"><i class="fa-solid fa-gear"></i> Services</a></li>
                <li><a href="../contact-us/"><i class="fa-solid fa-phone"></i> Contact Us</a></li>
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
        <section id="about">
            <div class="container">
                <h1>About Us</h1>
                <div class="content">
                    <div class="image">
                        <img src="../images/about.webp" alt="About Us Image">
                    </div>
                    <div class="text">
                        <p>We are a company dedicated to providing the best services to our clients. Our team is composed of professionals with extensive experience in various fields. We believe in quality, integrity, and customer satisfaction.</p>
                        <p>Our mission is to deliver top-notch solutions tailored to meet the unique needs of each client. We strive to exceed expectations and build long-lasting relationships based on trust and excellence.</p>
                    </div>
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