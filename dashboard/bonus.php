<?php
include '../connection.php';
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query_for_profile = "SELECT * FROM `registration` WHERE `email`='$email'";
    $result_for_profile = mysqli_query($conn, $query_for_profile);
    $row_for_profile = mysqli_fetch_assoc($result_for_profile);
} else {
    echo "<script>window.location.href = '../login/index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Big India Mart | Manage Your Services and Account</title>
    <meta name="description" content="Access your Big India Mart dashboard to manage your services, track orders, view account details, and stay updated with the latest offerings. Your personal hub for all services." />
    <meta name="keywords" content="Big India Mart Dashboard, Manage Services, Track Orders, Account Management, User Dashboard" />
    <meta name="robots" content="noindex, nofollow" />
    <link rel="canonical" href="https://bigindiamart.in/dashboard" />
    <link rel="stylesheet" href="style.css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://kit.fontawesome.com/bad18e3e79.js" crossorigin="anonymous"></script>
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
                <li><a href="../contact-us/"><i class="fa-solid fa-phone"></i> Contact Us</a></li>
                <?php
                if (isset($_SESSION['email'])) {
                    $email=$_SESSION['email'];
                    $query_service="SELECT * FROM `wallet` WHERE `email`='$email'";
                    $result_service=mysqli_query($conn,$query_service);
                    $cashbackAndBonus=mysqli_fetch_assoc($result_service)['wallet_point'];
                    echo '<li class="wallet-item"><a href="#"><i class="fa-solid fa-wallet"></i> Wallet <span class="wallet-point">'.$cashbackAndBonus.'</span></a></li>';
                    echo '<li><a href="index.php" class="active"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>';
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
    <div class="sidebar" id="sidebar">
        <div class="close-btn" id="close-btn">&times;</div>
        <ul class="menu">
            <li><a href="index.php"><i class="fa-solid fa-gear"></i> Previous Services</a></li>
            <li><a href="referral.php"><i class="fa-solid fa-share"></i> Referral</a></li>
            <li><a href="cashback.php"><i class="fa-solid fa-sack-dollar"></i> Cashback</a></li>
            <li><a href="bonus.php" class="active-sub"><i class="fa-solid fa-dollar-sign"></i> Bonus</a></li>
            <li><a href="redeem.php"><i class="fa-solid fa-gift"></i> Redeem</a></li>
            <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="toggle-btn" id="toggle-btn">&#9776;</div>
        <div class="services-section">
      <h2>Bonus</h2>
      <div class="cards">
        <?php
        $query_for_table = "SELECT * FROM `services` WHERE `user`='$email' and `status`='Closed'";
        $result_for_table = mysqli_query($conn, $query_for_table);
        $num_row=mysqli_num_rows($result_for_table);
        if($num_row>0){
            while ($row = mysqli_fetch_assoc($result_for_table)) {
                echo '<div class="card">
                  <h3>' . $row['services'] . '</h3>
                  <p class="date">Date: ' . $row['date'] . '</p>
                  <p class="date">Bonus: ' . $row['bonus'] . '</p>
                  <p class="status">Status: ' . $row['status'] . '</p>
              </div>';
              }
        }
        else{
            echo '<img class="folder-img" src="../images/folder.png" alt="Empty Folder">';
        }
        ?>
      </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //for Dashboard 
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggle-btn');
            const closeBtn = document.getElementById('close-btn');

            toggleBtn.addEventListener('click', function() {
                sidebar.style.width = '250px';
            });

            closeBtn.addEventListener('click', function() {
                sidebar.style.width = '0';
            });
            //for header
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
    </script>
</body>

</html>