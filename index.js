$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
const menuToggle = document.getElementById('menu-toggle');
const sidebarWrapper = document.getElementById('sidebar-wrapper');

menuToggle.addEventListener('click', function() {
    sidebarWrapper.classList.toggle('toggled');
    if (sidebarWrapper.classList.contains('toggled')) {
        menuToggle.textContent = "Hide Menu";
    } else {
        menuToggle.textContent = "Show Menu";
    }
});

// Check window width on page load and display toggle button accordingly
window.addEventListener('load', function() {
    if (window.innerWidth <= 768) { // Set your desired minimum width here
        menuToggle.classList.remove('d-none');
    }
});

// Check window width on resize and display toggle button accordingly
window.addEventListener('resize', function() {
    if (window.innerWidth <= 768) { // Set your desired minimum width here
        menuToggle.classList.remove('d-none');
    } else {
        menuToggle.classList.add('d-none');
    }
});
        function printPage() {
            window.print();
        }

        function saveAsPDF() {
            var pdf = new jsPDF();
            pdf.text("Monthly Report", 10, 10);
            pdf.save("monthly_report.pdf");
        }
        document.addEventListener("DOMContentLoaded", function() {
            const paymentMethodSelect = document.getElementById("paymentMethod");
            const creditCardInfo = document.getElementById("creditCardInfo");
            const paypalEmailField = document.getElementById("paypal-email-field");
            const mpesaNumberField = document.getElementById("mpesa-number-field");
            const banktransferinfo = document.getElementById("banktransferinfo");

            paymentMethodSelect.addEventListener("change", function() {
                const selectedMethod = paymentMethodSelect.value;
        
                // Hide all payment method specific fields initially
                creditCardInfo.style.display = "none";
                paypalEmailField.style.display = "none";
                mpesaNumberField.style.display = "none";
                banktransferinfo.style.display = "none";

                // Show the relevant fields based on the selected payment method
                if (selectedMethod === "creditCard" || selectedMethod === "debitCard") {
                    creditCardInfo.style.display = "block";
                } else if (selectedMethod === "paypal") {
                    paypalEmailField.style.display = "block";
                } else if (selectedMethod === "mpesa") {
                    mpesaNumberField.style.display = "block";
                } else if(selectedMethod === "banktransferinfo"){
                    banktransferinfo.style.display="block";
                }
            });
        });
        $(document).ready(function() {
            // Fetch billing data
            $.get('/billing', function(data) {
                let tableBody = $('#billing-data');
                data.forEach((item, index) => {
                    let row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.reading_date}</td>
                        <td>${item.due_date}</td>
                        <td>${item.current_reading}</td>
                        <td>${item.previous_reading}</td>
                        <td>${item.consumption}</td>
                        <td>${item.rate}</td>
                        <td>${item.status}</td>
                        <td>${item.amount}</td>
                    </tr>`;
                    tableBody.append(row);
                });
            });
        });
        $(document).ready(function() {
            $('#image-upload-form').submit(function(event) {
                event.preventDefault();
                
                var formData = new FormData($(this)[0]);
                
                $.ajax({
                    url: 'process_image.php', // URL to server-side script for image processing
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // Upon success, display extracted text in table
                        var extractedText = JSON.parse(data);
                        var tableBody = $('#extracted-text-body');
                        tableBody.empty();
                        $.each(extractedText, function(index, text) {
                            tableBody.append('<tr><td>' + (index + 1) + '</td><td>' + text + '</td></tr>');
                        });
                    }
                });
                
                return false;
            });
        });
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_bill.php',
                method: 'GET',
                success: function(data) {
                    const billingHistory = JSON.parse(data);
                    const tableBody = $('#billingTable tbody');
                    billingHistory.forEach((record, index) => {
                        const statusBadge = record.status === 'Paid' ? '<span class="badge badge-success">Paid</span>' : '<span class="badge badge-danger">Unpaid</span>';
                        tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${record.reading_date}</td>
                                <td>${record.due_date}</td>
                                <td>${record.current_reading}</td>
                                <td>${record.previous_reading}</td>
                                <td>${record.consumption}</td>
                                <td>${record.rate}</td>
                                <td>${statusBadge}</td>
                                <td>${record.amount}</td>
                            </tr>
                        `);
                    });
                    $('#billingTable').DataTable();
                }
            });
        });
            $(document).ready(function() {
                // Fetch and display profile details
                $.ajax({
                    url: 'fetch_profile.php', // Change this to your backend API endpoint
                    type: 'GET',
                    success: function(response) {
                        $('#profile-details').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching profile details:', error);
                        // Optionally, display an error message to the user
                    }
                });
            
                // Handle form submission to change password
                $('#change-password-form').submit(function(e) {
                    e.preventDefault();
                    var currentPassword = $('#current-password').val();
                    var newPassword = $('#new-password').val();
                    var confirmPassword = $('#confirm-password').val();
            
                    // Perform validation
                    if (newPassword !== confirmPassword) {
                        alert('New password and confirm password must match.');
                        return;
                    }
            
                    // Confirm password change
                    if (!confirm('Are you sure you want to change your password?')) {
                        return;
                    }
            
                    // Send data to backend to change password
                    $.ajax({
                        url: 'change_password.php', // Change this to your backend API endpoint
                        type: 'POST',
                        data: { currentPassword: currentPassword, newPassword: newPassword },
                        success: function(response) {
                            alert(response); // Display success or error message
                        },
                        error: function(xhr, status, error) {
                            console.error('Error changing password:', error);
                            // Optionally, display an error message to the user
                        }
                    });
                });
            });
            $(document).ready(function() {
                // Fetch user profile data
                $.ajax({
                    url: 'fetch_profile.php', // Your backend endpoint to fetch user data
                    type: 'POST',
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#username').val(data.username);
                        $('#email').val(data.email);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Handle error
                    }
                });
            });            

           
            function fetchBill(event) {
                event.preventDefault(); // Prevent default form submission
        
                var meterNumber = document.getElementById('meterNumber').value;
        
                // AJAX request to fetch bill amount
                $.ajax({
                    type: 'POST',
                    url: 'fetch_bill.php',
                    data: { meterNumber: meterNumber },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Display bill amount dynamically
                            alert('Amount to Pay: KES ' + response.amount); // Show amount in alert
                            // You can also update UI elements with the fetched amount
                        } else {
                            alert('No bill found for Meter Number: ' + meterNumber);
                        }
                    },
                    error: function() {
                        alert('Error fetching bill. Please try again.');
                    }
                });
            }
        
            // Attach event listener to form submit
            $(document).ready(function() {
                $('#fetchBillForm').submit(function(event) {
                    fetchBill(event); // Call fetchBill function on form submit
                });
            });
            function toggleCardFields() {
                var paymentType = document.getElementById('payment-type').value;
                var cardFields = document.getElementById('card-fields');
                var paypalEmailField = document.getElementById('paypal-email-field');
                var mpesaNumberField = document.getElementById('mpesa-email-field');
    
                if (paymentType === 'credit-card' || paymentType === 'debit-card') {
                    cardFields.style.display = 'block';
                    paypalEmailField.style.display = 'none';
                    mpesaNumberField.style.display = 'none';
                } else if (paymentType === 'paypal') {
                    cardFields.style.display = 'none';
                    paypalEmailField.style.display = 'block';
                    mpesaNumberField.style.display = 'none';
                } else if (paymentType === 'mpesa') {
                    cardFields.style.display = 'none';
                    paypalEmailField.style.display = 'none';
                    mpesaNumberField.style.display = 'block';
                } else {
                    cardFields.style.display = 'none';
                    paypalEmailField.style.display = 'none';
                    mpesaNumberField.style.display = 'none';
                }
            }