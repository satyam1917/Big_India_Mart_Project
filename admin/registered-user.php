<?php
include '../connection.php';
session_start();
if (isset($_SESSION['admin'])) {
} else {
    echo "<script>window.location.href = '../login/index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

    <div class="title-line">
        Admin Panel
    </div><br>
    <center><a href="index.php" class="regis-btn">Admin Panel</a><a href="redeem.php" class="regis-btn">Redeem</a></center><br>
    <center><h2>Registered User</h2></center>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th> <!-- Added City column -->
                </tr>
            </thead>
            <tbody>
                <?php
                $query_for_table = "SELECT * FROM `registration`";
                $result_for_table = mysqli_query($conn, $query_for_table);
                while ($row = mysqli_fetch_assoc($result_for_table)) {
                    echo '<tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['add1'].$row['add2'].' </td>
                    <td>'.$row['city'].'</td>
                </tr>';
                }
                ?>
                
                <!-- Other rows omitted for brevity -->
            </tbody>
        </table>
    </div>

    <!-- Details Popup -->
    <div class="popup" id="detailsPopup" style="display: none;">
        <span class="close-icon" onclick="closePopup()"></span>
        <div class="popup-header">
            <span>Details</span>
        </div>
        <div class="popup-body">
            <div class="info-group">
                <p><strong>Name:</strong> <span id="popupName"></span></p>
                <p><strong>Email:</strong> <span id="popupEmail"></span></p>
            </div>
            <div class="info-group">
                <p><strong>Phone:</strong> <span id="popupPhone"></span></p>
                <p><strong>Status:</strong> <span id="popupStatus"></span></p>
            </div>
            <div class="other-info">
                <div class="info-group">
                    <p><strong>Address:</strong></p>
                    <p><strong>Pincode:</strong></p>
                    <p><strong>City:</strong></p>
                    <p><strong>State:</strong></p>
                </div>
                <div class="info-group">
                    <p id="popupAddress"></p>
                    <p id="popupPincode"></p>
                    <p id="popupCity"></p>
                    <p id="popupState"></p>
                </div>
            </div>
        </div>
        <div class="popup-footer">
            <button class="btn-submit accept" onclick="acceptRequest()">Accept</button>
            <button class="btn-submit complete" onclick="completeRequest()">Complete</button>
        </div>
    </div>

    <!-- Completion Popup -->
    <div class="popup-1" id="completePopup" style="display: none;">
        <div class="popup-header-1">
            <span>Complete Request</span>
        </div>
        <div class="popup-body-1">

            <!-- Three selectable cards -->
            <div class="card" onclick="selectCard(1)" style="background-color: white;">
                <div class="card-header">
                    Coupon 1
                </div>
                <div class="card-body">
                    <button class="cashback">5%</button>
                </div>
            </div>
            <div class="card" onclick="selectCard(2)" style="background-color: white;">
                <div class="card-header">
                    Coupon 2
                </div>
                <div class="card-body">
                    <button class="cashback">10%</button>
                </div>
            </div>
            <div class="card" onclick="selectCard(3)" style="background-color: white;">
                <div class="card-header">
                    Coupon 3
                </div>
                <div class="card-body">
                    <button class="cashback">15%</button>
                </div>
            </div>
        </div>


    </div>


    <script>
        function acceptRequest(id) {
            jQuery.ajax({
                url: "accept_request.php",
                type: "POST",
                data: {
                    id: id
                },
                success: function(result) {
                    if (result == "ok") {
                        location.reload();
                    } else {
                        alert(result);
                    }

                }
            });
        }

        function closeRequest(id,email) {
            let cashback_point = prompt("Enter Cashback Point");
            let bonus_point = prompt("Enter Bonus Point");
            if (cashback_point != "") {
                if (bonus_point != "") {
                    jQuery.ajax({
                        url: "close_request.php",
                        type: "POST",
                        data: {
                            id: id,
                            cashback: cashback_point,
                            bonus: bonus_point,
                            email:email
                        },
                        success: function(result) {
                            if (result == "ok") {
                                location.reload();
                            } else {
                                alert(result);
                            }

                        }
                    });
                }
            }

        }
    </script>

</body>

</html>