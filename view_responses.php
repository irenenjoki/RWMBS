<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Images/waterlogo.jpg">
    <title>View Responses</title>
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

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
        }

        .email-header {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .email-field {
            margin-bottom: 10px; /* Adjusted spacing */
        }

        .email-field label {
            font-weight: bold;
            color: #333;
            display: block; /* Ensures label is on its own line */
            margin-bottom: 5px; /* Reduced space below the label */
        }

        .email-field p {
            margin: 0; /* Remove default margin */
            color: #555;
            padding: 2px 0; /* Slight padding for spacing */
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>View Responses</h1>
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
            $stmt = $conn->prepare("SELECT id, firstname, lastname, email, phone, issue, subject, admin_response, response_timestamp FROM report WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if results are found
            if ($result->num_rows > 0) {
                echo "<div class='email-container'>";
                echo "<div class='email-header'>Response Details</div>";
                while ($row = $result->fetch_assoc()) {
                    $timestamp = new DateTime($row["response_timestamp"]);
                    $formattedDateTime = $timestamp->format('F j, Y \a\t g:i A');

                    echo "<div class='email-field'><label>First Name:</label><p>" . htmlspecialchars($row["firstname"]) . "</p></div>";
                    echo "<div class='email-field'><label>Last Name:</label><p>" . htmlspecialchars($row["lastname"]) . "</p></div>";
                    echo "<div class='email-field'><label>Email:</label><p>" . htmlspecialchars($row["email"]) . "</p></div>";
                    echo "<div class='email-field'><label>Phone:</label><p>" . htmlspecialchars($row["phone"]) . "</p></div>";
                    echo "<div class='email-field'><label>Issue:</label><p>" . htmlspecialchars($row["issue"]) . "</p></div>";
                    echo "<div class='email-field'><label>Subject:</label><p>" . htmlspecialchars($row["subject"]) . "</p></div>";
                    echo "<div class='email-field'><label>Admin Response:</label><p>" . htmlspecialchars($row["admin_response"]) . "</p></div>";
                    echo "<div class='email-field'><label>Response Date and Time:</label><p>" . $formattedDateTime . "</p></div>";
                }
                echo "</div>";
            } else {
                echo "<p>No responses found for email: $email</p>";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
        ?>
        <a href="landing.php" class="btn-primary">HOME</a>
    </div>
</body>

</html>
   