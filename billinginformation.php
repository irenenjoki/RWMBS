<?php
session_start();
require_once "connect.php"; // Ensure this file exists and contains the $db variable

// Initialize variables
$bill_payment = [];
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meter_number = $_POST['meterNumber'];

    try {
        // Prepare SQL query to fetch data for the specified meter number
        $sql = 'SELECT * FROM process_payment WHERE meterNumber = :meterNumber';
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':meterNumber', $meter_number, PDO::PARAM_STR);
        $cmd->execute();
        $bill_payment = $cmd->fetchAll();
    } catch (PDOException $e) {
        $error_message = "Error fetching data: " . htmlspecialchars($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Information - Water Billing Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/waterlogo.jpg">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/d89edf4aa2.js" crossorigin="anonymous"></script>
    <style>
        .action-button {
    display: center;
    justify-content: space-between;
    margin-top: 20px;
}

.btn {
    padding: 1px 1px;
    border: none;
    border-radius: 50px;
    background-color: #01080e;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #2980b9;
}
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-white">WBMS</div>
            <div class="list-group list-group-flush">
                <a href="landing.html" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-home"></i> Home
                </a>
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="billinginformation.php" class="list-group-item list-group-item-action bg-dark text-white active">
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

        <div id="page-content-wrapper" class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary d-none" id="menu-toggle">Menu Bar</button>
                <div class="collapse navbar-collapse"></div>
            </nav>
            <div class="header">
                <a class="navbar-brand" href="landing.html">
                    <img src="Images/waterlogo.jpg" height="70" alt="Water logo">
                </a>
            </div>

            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h2 style="text-align: center; color: blue;">Water Billing Information</h2>
                        <div class="container">
                            <h2>Enter Your Meter Number</h2>
                            <form method="POST" action="billinginformation.php">
                                <div class="mb-3">
                                    <label for="meterNumber" class="form-label">Meter Number</label>
                                    <input type="text" class="form-control" id="meterNumber" name="meterNumber" required>
                                </div>
                                <button type="submit" class="btn btn-primary action-button">Submit</button>
                            </form>

                            <hr>

                            <?php
                            if (!empty($error_message)) {
                                echo "<p>$error_message</p>";
                            } elseif (!empty($bill_payment)) {
                                echo '<h2>Bill History</h2>';
                                echo '<table class="table">';
                                echo '<thead><tr><th>Meter Number</th><th>Amount in Ksh</th><th>Payment Mode</th></tr></thead>';
                                echo '<tbody>';
                                foreach ($bill_payment as $bill_payments) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($bill_payments['meterNumber']) . '</td>';
                                    echo '<td>' . htmlspecialchars($bill_payments['paymentAmount']) . '</td>';
                                    echo '<td>' . htmlspecialchars($bill_payments['paymentMethod']) . '</td>';
                                    echo '</tr>';
                                }
                                echo '</tbody></table>';
                            }
                            ?>

                            <button class="btn btn-primary action-button" onclick="printPage()">Print</button>
                            </div>
                    </div>
                </div>
            </div>
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
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="index.js"></script>
</body>

</html>
