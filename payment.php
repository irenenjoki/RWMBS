<?php
require_once './connect.php';
$query = $db->query('SELECT COUNT(*) as count FROM subscriptions');
$row = $query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Billing Management System - Payment Instructions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/waterlogo.jpg">
    <link rel="stylesheet" href="styles.css">
    <style>
        footer {
            background-color: rgb(0, 139, 185);
            color: #150202;
            font-weight: bold;
            text-decoration-line: none;
            text-align: center;
        }
        .footer-link-item1 {
            color: #d3d3d3;
            font-weight: bold;
            text-decoration-line: none;
        }
        .footer-link-item:hover {
            color: rgb(19, 19, 19);
            font-weight: normal;
        }
        .icon-link {
            color: rgb(255, 255, 255);
            font-size: 40px;
            font-weight: bold;
        }
        .icon-link:hover {
            color: rgb(19, 19, 19);
            font-weight: normal;
        }
        .arrow {
            font-size: 2rem;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        .arrow-left {
            left: 0;
        }
        .arrow-right {
            right: 0;
        }
        .card-container {
            position: relative;
            display: flex;
            justify-content: center;
        }
        .card {
            transition: opacity 0.3s ease-in-out;
        }
        .hidden {
            display: none;
        }
        .footer-link-item1 {
            color: #d3d3d3;
            font-weight: bold;
            text-decoration-line: none;
        }
        .footer-link-item:hover {
            color: rgb(19, 19, 19);
            font-weight: normal;
        }
        .icon-link {
            color: rgb(255, 255, 255);
            font-size: 40px;
            font-weight: bold;
        }
        .icon-link:hover {
            color: rgb(19, 19, 19);
            font-weight: normal;
        }
        
        .floating-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 20px;
            color: #000;
            z-index: 1000;
            background-color: #fff;
            border: 2px solid #000;
            border-radius: 50%;
            padding: 10px;
            text-align: center;
            width: 90px;
            height: 90px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .floating-icon .fa-bell {
            font-size: 24px;
        }

        .floating-icon span {
            font-size: 12px;
            margin-top: 5px;
        }
        .notifications {
            background-color: black;
            color: red;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading" style="color: rgb(0, 149, 199);">AquaTrack</div>
            <div class="list-group list-group-flush">
                <a href="landing.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-home"></i> Home
                </a>
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="billinginformation.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-file-invoice"></i> Billing Information
                </a>
                <a href="payment.php" class="list-group-item list-group-item-action bg-dark text-white active">
                    <i class="fas fa-credit-card"></i> Make Payment
                </a>
                <a href="profile.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <div id="page-content-wrapper" class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary d-none" id="menu-toggle">Menu Bar</button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0 custom-nav">
                        <li class="nav-item"></li>
                    </ul>
                    <a class="navbar-brand" href="landing.php">
                        <img src="Images/waterlogo.jpg" height="70" alt="Your choice logo">
                    </a>
                </div>
            </nav>

            <div class="container-fluid">
                <h1 style="text-align: center; color: blue" class="mt-4">How to Pay</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-container">
                            <!-- Card for M-Pesa Instructions -->
                            <div class="card" id="mpesaCard">
                                <div class="card-body">
                                    <h5 class="card-title">M-Pesa Payment Instructions</h5>
                                    <p class="card-text">
                                        To pay your Nairobi Water and Sewerage Company bill, go to your M-Pesa and select PayBill option.<br>
                                        Enter 444400 for business number and<br>
                                        Enter water meter number as your account number.<br>
                                        Finally put the bill amount, and PIN to confirm payment.
                                    </p>
                                </div>
                            </div>
                            <!-- Card for Airtel Money Instructions -->
                            <div class="card hidden" id="airtelCard">
                                <div class="card-body">
                                    <h5 class="card-title">Airtel Money Payment Instructions</h5>
                                    <p class="card-text">
                                        Select Airtel Money on your menu<br>
                                        Select Make Payments<br>
                                        Select Paybill<br>
                                        Select Nairobi Water<br>
                                        Enter the amount you want to pay in KES<br>
                                        Enter your PIN<br>
                                        Under reference, enter your Nairobi Water Account number
                                    </p>
                                </div>
                            </div>
                            <!-- Arrows for toggling -->
                            <span class="arrow arrow-left" onclick="showCard('mpesaCard')"><i class="fas fa-chevron-left"></i></span>
                            <span class="arrow arrow-right" onclick="showCard('airtelCard')"><i class="fas fa-chevron-right"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <!-- Optional: Include Font Awesome for icons -->
            <script src="https://kit.fontawesome.com/d89edf4aa2.js" crossorigin="anonymous"></script>

            <!-- Optional background image -->
            <img src="https://wallpaperkenya.co.ke/wp-content/uploads/2022/05/minimal-morning-landscape-8k-gx-scaled.jpg" 
                style="width: 100%; height: 300px; object-fit: cover;">

            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 text-center">
                            <hr class="pt-5 mt-5">
                        </div>
                        <div class="col-lg-4 col-md-12 text-center">
                            <br><br>
                            <span>AquaTrack</span>
                        </div>
                        <div class="col-lg-4 col-md-12 text-center">
                            <hr class="pt-5 mt-5">
                        </div>
                    </div> <!-- row end -->
                    <br><br>
                    <p>If you have any questions, do not hesitate to ask them.</p>
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-sm-10 px-2 py-3">
                            <div class="d-flex justify-content-between py-3 my-2">
                                <a href="https://twitter.com/irinnahrin" class="icon-link"><i class="fab fa-twitter"></i></a>
                                <a href="https://web.whatsapp.com/" class="icon-link"><i class="fab fa-whatsapp"></i></a>
                                <a href="https://www.instagram.com/irene.waweru.100/" class="icon-link"><i class="fab fa-instagram"></i></a>
                                <a href="www.facebook.com" class="icon-link"><i class="fab fa-facebook"></i></a>
                            </div>
                        </div>
                    </div>
                    <i class="fa fa-map-marker w3-text-red" style="width:30px"></i> Nairobi, Kenya<br><br>
                    <i class="fa fa-phone w3-text-red" style="width:30px"></i> Phone: 0711791575<br>
                    <div class="py-2 p-1 m-2">
                        <i class="fas fa-envelope-open-text fs-30"></i>
                        <a href="mailto:irenewaweru9@gmail.com"><span class="footer-link-item1"> aquatrackafrica@gmail.com</span></a>
                    </div>
                    <p id="current-year"></p>
                </footer>
                <a href="view_responses.php" class="floating-icon notifications">
    <span>Notifications</span>
    <i class="fas fa-bell"></i>
    <span><?php echo $row['count']; ?></span>
</a>
            <!-- JavaScript for toggling cards -->
            <script>
                function showCard(cardId) {
                    var mpesaCard = document.getElementById('mpesaCard');
                    var airtelCard = document.getElementById('airtelCard');
                    
                    if (cardId === 'mpesaCard') {
                        mpesaCard.classList.remove('hidden');
                        airtelCard.classList.add('hidden');
                    } else if (cardId === 'airtelCard') {
                        mpesaCard.classList.add('hidden');
                        airtelCard.classList.remove('hidden');
                    }
                }

                // Initialize the first card to be visible
                showCard('mpesaCard');
            </script>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="index.js"></script>
        </div>
    </div>
</body>
</html>
