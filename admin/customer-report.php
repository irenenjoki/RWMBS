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

    <title>Reports</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-menu">
            <label class="logo">WaTer-SerVe <small>.com </small></label>
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
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                    <input type="text" placeholder="search" />
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
        <?php
require_once "./connect.php";
?>


        <div class="content">
            <div class="content-2">

                <div class="new-students">
                    <div class="title">
                        <h2>Customer reports</h2>
                        <a href="#" class="btn">view All</a>
                    </div>

                    <table>

                        <thead>
                            <tr>
                                
                                <th>firstname</th>
                                <th>laststname</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>issue</th>
                                <th>subject</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

$sql = 'SELECT * FROM report';
$cmd = $db->prepare($sql);
$cmd->execute();

$reports = $cmd->fetchAll();
foreach($reports as $report) {
  echo '
          <tr>
            
            <td>'.$report['firstname'].'</td>
            <td>'.$report['lastname'].'</td>
            <td>'.$report['email'].'</td>
            <td>'.$report['phone'].'</td>
            <td>'.$report['issue'].'</td>
            <td>'.$report['subject'].'</td>
            <td><a href="delete-report.php?firstname='.$report['firstname'].'"><i class="fas fa-trash-alt"></i></a></td>
            
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
</body>

</html>