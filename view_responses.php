<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Images/waterlogo.jpg">

    <title>View Responses </title>
    <style>
        /* Custom styles */
        body {
            background-image: url('https://images.pexels.com/photos/6387866/pexels-photo-6387866.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: auto;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Button style */
        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-left: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            color: #555;
        }
    </style>
</head>

<body>
    <h1>View Responses </h1>
    <form action="view_responses.php" method="POST">
        <label for="email">Enter Your Email:</label>
        <input type="text" id="email" name="email" placeholder="Your email...">
        <button type="submit">Search</button>
    </form>

    <?php
    // Check if email is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);

        // Replace these variables with your actual database connection details
        $servername = "localhost";
        $username = "root";
        $password = ""; // Assuming you are using no password for localhost
        $dbname = "water_management";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to fetch responses by email
        $stmt = $conn->prepare("SELECT id,firstname, lastname, email, phone, issue, subject, admin_response, response_timestamp FROM report WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if results are found
        if ($result->num_rows > 0) {
            echo "<h2>Responses for Email: $email</h2>";
            echo "<table>";
            echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Issue</th><th>Subject</th><th>Admin Response</th><th>Response Timestamp</th></tr></thead>";
            echo "<tbody>";
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["firstname"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["lastname"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["issue"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["subject"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["admin_response"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["response_timestamp"]) . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No responses found for email: $email</p>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
         <a href="landing.html" class="btn btn-primary" style="margin-left: 1050px;">HOME</a>

</body>

</html>
