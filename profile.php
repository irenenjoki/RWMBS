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
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/waterlogo.jpg">
    <script src="https://kit.fontawesome.com/d89edf4aa2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
        .password-hidden {
            position: relative;
            cursor: pointer;
            display: inline-block;
        }

        .password-hidden::after {
            content: "********";
            position: absolute;
            left: 0;
            right: 0;
            white-space: nowrap; /* Prevent line breaks */

        }

        .password-hidden:hover::after {
            content: attr(data-password);
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
                <a href="billinginformation.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-file-invoice"></i> Billings Information
                </a>
                <a href="payment.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-credit-card"></i> Make Payment
                </a>
                <a href="profile.php" class="list-group-item list-group-item-action bg-dark text-white active">
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
    <button class="btn btn-primary d-none" id="menu-toggle"> Menu Bar</button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user"></i> <span id="currentUsername">My Account</span>
                </a>
            </li>
        </ul>
    </div>
</nav>


            <div class="container-fluid">
                <h1 style="text-align: center;" class="mt-4">User Profile</h1>

                <div id="profileDetails" class="card mt-4">
                    <div class="card-body">
                        <h4 class="card-title">Profile Information</h4>
                        <div id="profileContent">
                            <!-- Profile details will be loaded here -->
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Footer -->
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
        <a href="view_responses.php" class="floating-icon notifications">
    <span>Notifications</span>
    <i class="fas fa-bell"></i>
    <span><?php echo $row['count']; ?></span>
</a>
    <!-- /Footer -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to fetch and display user profile details using AJAX
        $(document).ready(function () {
    // Fetch and display user profile details
    $.ajax({
        url: 'fetch_profile.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Profile Data:", data); // Add this line to debug

            if (data !== null) {
                $('#profileContent').html(`
                    <p><strong>Username:</strong> ${data.name}</p>
                    <p><strong>Email:</strong> ${data.email}</p>
                    <p><strong>Phone Number:</strong> ${data.phonenumber}</p>
                    <p><strong>Meter Number:</strong> ${data.meterNumber}</p>
                    <p><strong>Password:</strong> <span class="password-hidden" data-password="${data.passwords}"></span></p>
                `);
            } else {
                $('#profileContent').html('<p>No profile data found.</p>');
            }
        },
        error: function () {
            console.error('Error fetching profile data'); // Add this line to debug
            $('#profileContent').html('<p>Log In To Your Account.</p>');
        }
    });

    // Fetch and display the current username
    $.ajax({
        url: 'fetch_username.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log("Username Response:", response); // Add this line to debug

            if (response.success) {
                $('#currentUsername').text(response.username);
            } else {
                $('#currentUsername').text('My Account');
            }
        },
        error: function () {
            console.error('Error fetching username'); // Add this line to debug
            $('#currentUsername').text('My Account');
        }
    });

    // Submit form to change password
    $('#changePasswordForm').submit(function (event) {
        event.preventDefault();
        var currentPassword = $('#current-password').val();
        var newPassword = $('#new-password').val();
        var confirmPassword = $('#confirm-password').val();

        // AJAX call to change password
        $.ajax({
            url: 'change_password.php',
            type: 'POST',
            data: {
                current_password: currentPassword,
                new_password: newPassword,
                confirm_password: confirmPassword
            },
            success: function (response) {
                alert(response.message);
                // Clear form fields after successful password change
                $('#current-password').val('');
                $('#new-password').val('');
                $('#confirm-password').val('');
            },
            error: function () {
                alert('Error changing password.');
            }
        });
    });
});

    </script>
    <!-- /Scripts -->
</body>
</html>
