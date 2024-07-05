<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/9b1965001a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/Style.css" type="text/css" />

    <title>admin panel</title>
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
                    <a href="signout.php">signout&nbsp;<i class="fas fa-sign-out-alt"></i></a>
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
                           $query = $db->query('SELECT * FROM users');
                           if($query->rowCount()){
                               echo $query->rowCount();
                           }
                           else{
                               echo '0';
                           }
                        ?>
                        <h1>Registered customers</h1>

                    </div>
                    <div class="icon-case">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <div class="card" id="card2">
                    <div class="box">
                        <?php
                         require_once './connect.php';
                           $query = $db->query('SELECT * FROM users');
                           if($query->rowCount()){
                               echo $query->rowCount();
                           }
                           else{
                               echo '0';
                           }
                        ?>
                        <h1>Daily visitors</h1>


                    </div>
                    <div class="icon-case">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <?php
require_once "./connect.php";
?>

                <div class="card" id="card3">
                    <div class="box">

                        <h1>Successful Registered customers</h1>

                        <table>

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>firstname</th>
                                    <th>lastname</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>status</th>
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
            <td>'.$report['id'].'</td>
            <td>'.$report['firstname'].'</td>
            <td>'.$report['lastname'].'</td>
            <td>'.$report['email'].'</td>
            <td>'.$report['phone'].'</td>
            <td><a href="delete-attendance.php?id='.$report['id'].'" id="success" >successful</a></td>
            
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
</body>

</html>