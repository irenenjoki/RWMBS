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
        //Your script to fetch and inject payment history data goes here
            // Example script to fetch and inject payment history data
            // Replace this with your actual implementation
            $(document).ready(function() {
                // Event listener for the fetch bill button
                $("#fetchBillBtn").click(function() {
                    var meterNumber = $("#meterNumber").val(); // Get the meter number from the input field
    
                // AJAX request to fetch payment history data based on meter number
                $.ajax({
                    url: 'fetch_bill.php', // Change this to your PHP script
                    type: 'POST',
                    data: {
                        meterNumber: '1234567' // Example meter number, replace with actual value from billing information page
                    },
                    success: function(response) {
                        // Inject the payment history data into the table body
                        $('#billinginformation ').html(response);
                    }
                });
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