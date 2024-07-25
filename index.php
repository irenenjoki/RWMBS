
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Billing Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/waterlogo.jpg">
    <script src="https://kit.fontawesome.com/d89edf4aa2.js" crossorigin="anonymous"></script>
    <style>
        .container {
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .textbox {
            margin: 10px 0;
            position: relative;
        }
        .textbox i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer; /* Ensure the icon is clickable */
        }
        .textbox input {
            width: 100%;
            padding: 10px 10px 10px 30px;
            border: none;
            border-bottom: 2px solid #000;
            outline: none;
        }
        .btn {
            background: #000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn:hover {
            background: #444;
        }
        .new-user {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1>Water Billing Management System</h1>
            <form id="login" action="login.php" method="post">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Name" id="username" name="name" required>
                </div>
                <div class="textbox">
                    <i class="fas fa-eye" id="togglePassword"></i>
                    <input type="password" placeholder="Password" id="password" name="passwords" required>
                </div>
                <div class="textbox">
                    <i class="fas fa-tachometer-alt"></i>
                    <input type="text" placeholder="Meter Number" id="meterNumber" name="meterNumber" required>
                </div>
                <button type="submit" class="btn">Sign In</button>
            </form><br>
            <p id="errorMessage" style="color: red;"></p>
            <p id="forgotPasswordMessage" style="display: none; color: red;">Forgot your password?</p>
            <div class="new-user">
                <button onclick="window.location.href='register.html'" class="btn">New User</button>
            </div>
        </div> 
    </div>
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // Toggle eye icon styles based on password visibility
            this.classList.toggle('fa-eye-slash');
        });

        // Validate and submit form using AJAX
        document.getElementById('login').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            const meterNumber = document.getElementById('meterNumber').value.trim();
            const errorMessage = document.getElementById('errorMessage');
            const forgotPasswordMessage = document.getElementById('forgotPasswordMessage');

            // Basic client-side validation
            if (!username || !password || !meterNumber) {
                errorMessage.textContent = 'Please fill in all required fields.';
                forgotPasswordMessage.style.display = 'none';
                return;
            } 
             // Password complexity validation
             const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/;
             if (!passwordRegex.test(password)) {
                 errorMessage.textContent = 'Password must be at least 8 characters long, contain at least one uppercase letter, and at least one symbol.';
                 return;
             }
 
            // Prepare and send AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'login.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Redirect to dashboard.php after successful login
                        window.location.href = 'dashboard.php';
                    } else {
                        // Display error message based on response
                        errorMessage.textContent = response.error || 'Wrong username, password, or meter number.';
                        forgotPasswordMessage.style.display = 'block';
                    }
                } else {
                    errorMessage.textContent = 'Error: ' + xhr.statusText;
                    forgotPasswordMessage.style.display = 'block';
                }
            };
            xhr.onerror = function () {
                errorMessage.textContent = 'An error occurred during the request.';
                forgotPasswordMessage.style.display = 'block';
            };
            xhr.send(`name=${encodeURIComponent(username)}&passwords=${encodeURIComponent(password)}&meterNumber=${encodeURIComponent(meterNumber)}`);
        });
    </script>
</body>
</html>
