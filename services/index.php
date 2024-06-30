<?php
include '../connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://kit.fontawesome.com/bad18e3e79.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <title>Our Services - Big India Mart | Comprehensive Service Solutions in India</title>
  <meta name="description" content="Discover the wide range of services offered by Big India Mart, including educational, legal, banking, insurance, house rent, grocery, shopping, construction, civil construction, tour and travel, and event management services. Your one-stop solution for all essential services in India." />
  <meta name="keywords" content="Big India Mart Services, Educational Services, Legal Services, Banking Services, Insurance Services, House Rent Services, Grocery Shopping, Daily Needs, Construction Services, Civil Construction Services, Tour and Travel, Event Management" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://bigindiamart.in/services" />

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
        <li><a href="../services/" class="active"><i class="fa-solid fa-gear"></i> Services</a></li>
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
    <div class="toggle-btn" onclick="slider_open()">&#9776;</div>
    <div class="service-list" id="service-list">
      <div class="close-btn" onclick="slider_close()">&times;</div>
      <!-- Services will be injected here by JavaScript -->
    </div>
    <div class="service-details" id="service-details">
      <div class="service-info">
        <h2 id="service-title"></h2>
        <p id="service-description"></p>
        <form action="" method="post">
          <textarea name="message" id="message" rows="7" cols="50" placeholder="Your Message..."></textarea>
        </form>
        <button id="register-button" class="register-button">Book Now</button>
      </div>
    </div>
  </main>
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
    
    
    // code for slider
    function slider_open() {
      let menu_item=document.getElementById('service-list');
      menu_item.style.marginLeft='0px';
      menu_item.style.transition='margin 1s';
    }

    function slider_close() {
      let menu_item=document.getElementById('service-list');
      menu_item.style.marginLeft='-250px';
      menu_item.style.transition='margin 1s';
    }

    function logout() {
      jQuery.ajax({
        url: "../logout/index.php",
        type: "POST",
        data: {
          data: "logout"
        },
        success: function(result) {
          if (result == "ok") {
            window.location.href = "../login/";
          } else {
            alert(result);
          }

        }
      });
    }
  </script>
</body>

</html>
<script src="index.js"></script>