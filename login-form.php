<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login Form</title>
    <link rel="stylesheet" href="./css/styling.css" />
    <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet" />
</head>

<body>
    <form class="container-log" method="post" id="login-form.php" action="./controller/login.php">
        <h1>WaTer-serve.com</h1>
        <h2>Login</h2>
        <input type="text" name="Username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button class="logbtn">Login</button>
        <button class="logbtn">
            <a href="Sign-up.php">Sign up</a>
        </button>
    </form>
</body>

</html>