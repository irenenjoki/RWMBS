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
    <title>Water Billing Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/waterlogo.jpg">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/d89edf4aa2.js" crossorigin="anonymous"></script>
    <style>
        footer {
            background-color: rgb(0, 139, 185);
            color: #150202;
            font-weight: bold;
            text-decoration-line: none;
            text-align: center;
        }

        .footer-link-item {
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
            background-color: black;
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
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading" style="color: rgb(0, 149, 199);">AquaTrack</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-home"></i> Home</a>
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark text-white active">
                    <i class="fa fa-tachometer-alt"></i> Dashboard</a>
                <a href="billinginformation.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-file-invoice"></i> Billing Information
                </a>
                <a href="payment.php" class="list-group-item list-group-item-action bg-dark text-white">
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
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
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
                <h1 style="text-align: center; color:blue" class="mt-4">Water Billing Management System</h1>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="card">
                            <img src="https://t3.ftcdn.net/jpg/06/27/46/82/360_F_627468238_sYcmPsqQkoo43SvvdoHOSDNSXmFEFX4N.jpg" class="card-img-top" alt="Billing Information">
                            <div class="card-body">
                                <h5 class="card-title">Billing Information</h5>
                                <p class="card-text">View your billing information and history.</p>
                                <a href="billinginformation.php" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="card">
                            <img src="https://cdn.shopify.com/s/files/1/2723/8896/files/daubzh5nu52rj0tlfhci.jpg?v=1716538061" class="card-img-top" alt="Make Payment">
                            <div class="card-body">
                                <h5 class="card-title">Make Payment</h5>
                                <p class="card-text">Make payments for your water bills securely.</p>
                                <a href="payment.php" class="btn btn-primary">Make Payment</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="card">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/009/209/212/small/neon-glowing-profile-icon-3d-illustration-vector.jpg" class="card-img-top" alt="User Profile">
                            <div class="card-body">
                                <h5 class="card-title">User Profile</h5>
                                <p class="card-text">View and update your profile information.</p>
                                <a href="profile.php" class="btn btn-primary">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <img src="https://wallpaperkenya.co.ke/wp-content/uploads/2022/05/minimal-morning-landscape-8k-gx-scaled.jpg" style="width: 100%; height: 300px; object-fit: cover;">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 text-center">
                    <hr class="pt-5 mt-5">
                </div>
                <div class="col-lg-4 col-md-12 text-center">
                    <br>
                    <span>AquaTrack</span>
                </div>
                <div class="col-lg-4 col-md-12 text-center">
                    <hr class="pt-5 mt-5">
                </div>
            </div>
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
                <a href="mailto:irenewaweru9@gmail.com"><span class="footer-link-item"> aquatrackafrica@gmail.com</span></a>
            </div>
            <p id="current-year"></p>
        </footer>
        <a href="view_responses.php" class="floating-icon notifications">
    <span>Notifications</span>
    <i class="fas fa-bell"></i>
    <span><?php echo $row['count']; ?></span>
</a>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="index.js"></script>
    </body>
    </html>
