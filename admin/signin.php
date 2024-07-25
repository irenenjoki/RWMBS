<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login </title>
    <link rel="stylesheet" href="./css/Style.css" />
    <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/d89edf4aa2.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="image\waterlogo.jpg">

    <style>
        .password-container {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="main-cont">
        <form class="container-log" method="post" action="login.php" id="login-form">
            <h1>WaTer-serve.com</h1>
            <h2>Login</h2>
            <input type="text" id="username" name="username" placeholder="Username" required />
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required />
                <i class="fas fa-eye input-icon" id="togglePassword"></i>
            </div>
            <input type="text" id="code" name="code" placeholder="Company Code (if applicable)" />

            <button type="submit" class="logbtn">Login</button>
            <button onclick="window.location.href='register.html'" class="btn">New User</button>
            <button type="submit" class="btn" onclick="window.location.href='/water/register.html'">Register As User</button>

            <p id="errorMessage" style="color: red;"></p>
        </form>
    </div>

    <script>
        // Password Visibility Toggle
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        // Validate and submit form using AJAX
        document.getElementById('login-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            const code = document.getElementById('code').value.trim();
            const errorMessage = document.getElementById('errorMessage');

            // Basic client-side validation
            if (!username || !password) {
                errorMessage.textContent = 'Please fill in all required fields.';
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
                        // Redirect to index.php after successful login
                        window.location.href = 'index.php';
                    } else {
                        // Display error message based on response
                        errorMessage.textContent = response.error || 'Wrong username or password.';
                    }
                } else {
                    errorMessage.textContent = 'Error: ' + xhr.statusText;
                }
            };
            xhr.onerror = function () {
                errorMessage.textContent = 'An error occurred during the request.';
            };
            xhr.send(`username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}&code=${encodeURIComponent(code)}`);
        });
    </script>
    </body>
    </html>