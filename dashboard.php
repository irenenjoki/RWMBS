

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Water Billing Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images\waterlogo.jpg">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/d89edf4aa2.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-white">WBMS</div>
            <div class="list-group list-group-flush">
                <a href="landing.html" class="list-group-item list-group-item-action bg-dark text-white">
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
                       
                        <li class="nav-item">
                            
                        </li>
                    </ul>
                    <a class="navbar-brand" href="landing.html">
                        <img src="Images\waterlogo.jpg" height="70" alt="Your choise logo">
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
                                <a href="payment.html" class="btn btn-primary">Make Payment</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="card">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/009/209/212/small/neon-glowing-profile-icon-3d-illustration-vector.jpg" class="card-img-top" alt="User Profile">
                            <div class="card-body">
                                <h5 class="card-title">User Profile</h5>
                                <p class="card-text">View and update your profile information.</p>
                                <a href="profile.html" class="btn btn-primary">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <footer>
        <div class="footer">
            <h5>Find Us On</h5>
            <div class="w3-xlarge w3-padding-16">
                <i class="fa fa-facebook-official w3-hover-opacity"></i>
                <i class="fa fa-instagram w3-hover-opacity"></i>
                <i class="fa fa-twitter w3-hover-opacity"></i>
                <i class="fa fa-linkedin w3-hover-opacity"></i>
            </div>
            <p>Powered by <a href="mailto:irenewaweru9@gmail.com" target="_blank" class="w3-hover-text-green">RWMBS</a></p>
            &copy; 2024 RWMBS. All rights reserved.
            <br>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="index.js"></script>
</body>
</html>
