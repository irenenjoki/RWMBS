<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/waterlogo.jpg">
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
                                <i class="fas fa-user"></i> My Account
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

                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form id="changePasswordForm">
                            <div class="form-group mb-3">
                                <label for="current-password">Current Password</label>
                                <input type="password" id="current-password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="new-password">New Password</label>
                                <input type="password" id="new-password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" id="confirm-password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Footer -->
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
    <!-- /Footer -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to fetch and display user profile details using AJAX
        $(document).ready(function () {
            $.ajax({
                url: 'fetch_profile.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
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
                    $('#profileContent').html('<p>Log In To Your Account.</p>');
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
