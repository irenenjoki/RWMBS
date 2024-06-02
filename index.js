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
        