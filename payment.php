<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Billing Management System - Make Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/waterlogo.jpg">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/d89edf4aa2.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-white">WBMS</div>
            <div class="list-group list-group-flush">
                <a href="landing.html" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-home"></i> Home</a>
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-tachometer-alt"></i> Dashboard</a>
                <a href="billinginformation.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-file-invoice"></i> Billing Information</a>
                <a href="payment.php" class="list-group-item list-group-item-action bg-dark text-white active">
                    <i class="fas fa-credit-card"></i> Make Payment</a>
                <a href="profile.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-user"></i> Profile</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-sign-out-alt"></i> Logout</a>
             
            </div>
        </div>

        <div id="page-content-wrapper" class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary d-none" id="menu-toggle">Menu Bar</button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0 custom-nav">
                        <li class="nav-item"></li>
                    </ul>
                    <a class="navbar-brand" href="dashboard.html">
                        <h1 style="font-family: Snap ITC; color: blue">RWMBS</h1>
                    </a>
                </div>
            </nav>

            <div class="container-fluid">
                <h1 style="text-align: center; color: blue" class="mt-4">Make Payment</h1>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Payment Method</h5>
                                <p class="card-text">Choose your preferred payment method and complete your payment securely.</p>
                                <form id="paymentForm" action="controller/paybill.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="meterNumber" class="form-label">Meter Number:</label>
                                        <input type="text" class="form-control" id="meterNumber" name="meterNumber" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="paymentAmount" class="form-label">Amount:</label>
                                        <input type="number" class="form-control" id="paymentAmount" name="paymentAmount" placeholder="Enter amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="paymentMethod" class="form-label">Payment Method:</label>
                                        <select id="paymentMethod" name="paymentMethod" class="form-select" onchange="togglePaymentFields()" required>
                                            <option value="" disabled selected>Select payment method</option>
                                            <option value="mpesa">M-Pesa</option>
                                        </select>
                                    </div>

                                    <div id="mpesa-fields" style="display: none;">
                                        <div class="mb-3">
                                            <label for="mpesa-number" class="form-label">M-Pesa Phone Number:</label>
                                            <input type="text" class="form-control" id="mpesa-number" name="mpesa-number" placeholder="Enter M-Pesa Phone Number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mpesa-pin" class="form-label">M-Pesa PIN:</label>
                                            <input type="password" class="form-control" id="mpesa-pin" name="mpesa-pin" placeholder="Enter M-Pesa PIN" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
                                </form>
                                <div id="paymentSuccessMessage" style="display: none;">
                                    <p class="text-success mt-3">Payment successful!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="footer text-center mt-5">
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
    
    <script>
        function togglePaymentFields() {
            var paymentType = document.getElementById('paymentMethod').value;
            var mpesaFields = document.getElementById('mpesa-fields');

            if (paymentType === 'mpesa') {
                mpesaFields.style.display = 'block';
            } else {
                mpesaFields.style.display = 'none';
            }
        }

        // Submit form handler
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting
            
            // Make an AJAX request to handle form submission
            var form = this;
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Handle success or error based on response
                if (data.includes('Error')) {
                    alert(data); // Display error message
                } else {
                    // Show payment success message
                    document.getElementById('paymentSuccessMessage').style.display = 'block';
                    form.reset(); // Reset form fields if needed
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: Unable to process payment.'); // Generic error message
            });
        });
    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="index.js"></script>
</body>
</html>
