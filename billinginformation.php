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
        footer{
	background-color:rgb(0, 139, 185);
	color: #150202;
	font-weight: bold;
	text-decoration-line: none;
	text-align: center;
}

.footer-link-item1{
     color: #d3d3d3;
     font-weight: bold;
     text-decoration-line: none;
}
.footer-link-item:hover{
     color: rgb(19, 19, 19);
     font-weight: normal;
}
.icon-link{
     color: rgb(255, 255, 255);
     font-size: 40px;
     font-weight: bold;
}
.icon-link:hover{
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
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
        <div class="sidebar-heading" style="color: rgb(0, 149, 199);">AquaTrack</div>
        <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action bg-dark text-white">
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
                <a class="navbar-brand" href="landing.php">
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

                            <!-- PHP script output will go here -->
                            <div id="billingInfo">
                                <?php
                                // Check if meterNumber is set and not empty
                                if(isset($_POST['meterNumber']) && !empty($_POST['meterNumber'])) {
                                    // Sanitize input to prevent SQL injection (you can expand this based on your needs)
                                    $meterNumber = htmlspecialchars($_POST['meterNumber']);

                                    // Replace with your actual database connection details
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "water_management";

                                    // Create connection
                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Prepare SQL statement with placeholders
                                    $sql = "SELECT * FROM process_payment WHERE meterNumber = ?";

                                    // Use prepared statement to prevent SQL injection
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("s", $meterNumber); // "s" indicates the type of the parameter (string)
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    // Check if any rows were returned
                                    if ($result->num_rows > 0) {
                                        // Start creating the table
                                        echo '<table class="table table-striped">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th scope="col">Meter Number</th>';
                                        echo '<th scope="col">Payment Method</th>';
                                        echo '<th scope="col">Payment Amount</th>';
                                        echo '<th scope="col">TransactionDate</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';

                                        // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $row["meterNumber"] . '</td>';
                                            echo '<td>' . $row["paymentMethod"] . '</td>';
                                            echo '<td>sh' . $row["paymentAmount"] . '</td>';
                                            echo '<td>' . $row["TransactionDate"] . '</td>';
                                            echo '</tr>';
                                        }

                                        echo '</tbody>';
                                        echo '</table>';
                                    } else {
                                        echo "No billing information found for meter number: " . $meterNumber;
                                    }

                                    // Close prepared statement and database connection
                                    $stmt->close();
                                    $conn->close();

                                } else {
                                    echo "Enter your meter number above to view billing information.";
                                }
                                ?>
                                 <button class="btn btn-primary action-button" onclick="printPage()">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="https://wallpaperkenya.co.ke/wp-content/uploads/2022/05/minimal-morning-landscape-8k-gx-scaled.jpg" 
    style="width: 100%; height: 300px; object-fit: cover;">
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
                </div> <!--row end--><br><br>
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
            <i class="fa fa-map-marker w3-text-red" style="width:30px"></i> Nairobi,Kenya<br><br>
            <i class="fa fa-phone w3-text-red" style="width:30px"></i> Phone: 0711791575<br>
            <div class="py-2 p-1 m-2">
                <i class="fas fa-envelope-open-text fs-30"></i>
                <a href="mailto:irenewaweru9@gmail.com"><span class="footer-link-item1"> aquatrackafrica@gmail.com</span></a>
              </div>
            <p id="current-year"></p> 
        </footer>
        </div>
    </div>
   <a href="view_responses.php" class="floating-icon notifications">
    <span>Notifications</span>
    <i class="fas fa-bell"></i>
    <span>
        <?php
        if (isset($row['count'])) {
            echo htmlspecialchars($row['count']);
        }
        ?>
    </span>
</a>

    <script>
        function printPage() {
            window.print();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>