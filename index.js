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
