<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/Style.css" type="text/css" />
    <link rel="icon" type="image/png" href="image\waterlogo.jpg">

    <title>customers</title>
    <style>
   
        .card {
            width: 30%;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }
        .box {
            padding: 80px;
        }
        #card3 {
  width: 80vw;
  height: 130vh;
  padding-bottom: 200px;
}
</style>
</head> 

<body>
    <div class="side-menu">
        <div class="brand-menu">
            <label class="logo">AquaTrack <small>.com </small></label>
        </div>
        <ul>
            <a href="index.php">
                <li><i class="fas fa-grip-horizontal"></i>&nbsp;Dashboard</li>
            </a>
            <a href="customer.php">
                <li><i class="fas fa-user-tie"></i>&nbsp;Customers</li>
            </a>
            <a href="customer-report.php">
                <li><i class="fab fa-wpforms"></i>&nbsp;Customer reports</li>
            </a>
            <a href="subscriptions.php">
                <li><i class="fas fa-envelope-open-text"></i>&nbsp;Subscriptions</li>
            </a>
            <a href="billhistory.php">
                <li><i class="fas fa-history"></i>&nbsp;Bill History</li>
            </a>
            <a href="contact.php">
                <li><i class="fas fa-comment"></i>&nbsp;User Messages</li>
            </a>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                    <input type="text" placeholder="Search" />
                    <button type="submit"><i class="fab fa-searchengin"></i></button>
                </div>
                <div class="user">
                    <a href="registration-form.php" class="btn">Add New</a>
                </div>
                <div class="signout">
                    <a href="signout.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
        <div class="content">
            <h1>WELCOME ADMIN !!</h1>
            <div class="cards">
                <div class="card" id="card1">
                    <div class="box">
                        <?php
                        require_once './connect.php';
                        $query = $db->query('SELECT COUNT(*) as count FROM register');
                        $row = $query->fetch(PDO::FETCH_ASSOC);
                        echo '<h1>Registered customers</h1>';
                        echo '<p>' . $row['count'] . '</p>';
                        ?>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <div class="card" id="card2">
                    <div class="box">
                        <?php
                        $query = $db->query('SELECT COUNT(*) as count FROM register');
                        $row = $query->fetch(PDO::FETCH_ASSOC);
                        echo '<h1>Daily visitors</h1>';
                        echo '<p>' . $row['count'] . '</p>';
                        ?>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="card" id="card3">
                    <div class="box">
                        <h1>Successful Registered customers</h1>
                        <div class="content-2">
                            <div class="recent-payments">
                                <div class="title">
                                    <h2>Customers</h2>
                                    <a href="#" class="btn">View All</a>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Meter Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = 'SELECT * FROM register';
                                        $cmd = $db->prepare($sql);
                                        $cmd->execute();
                                        $users = $cmd->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($users as $user) {
                                            echo '
                                                <tr>
                                                    <td>' . htmlspecialchars($user['name']) . '</td>
                                                    <td>' . htmlspecialchars($user['email']) . '</td>
                                                    <td>' . htmlspecialchars($user['phonenumber']) . '</td>
                                                    <td>' . htmlspecialchars($user['meterNumber']) . '</td>
                                                    <td>
                                                        <a href="delete-customers.php?name=' . htmlspecialchars($user['name']) . '"><i class="fas fa-trash-alt"></i></a>&nbsp;
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
