<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Title -->
    <title>Bill Payments History</title>
    <!-- Link to styling.css -->
    <script src="https://kit.fontawesome.com/9b1965001a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/styling.css" />
    <!-- Favicon -->
</head>

<body class="bill-body">
    <!-- Navigation bar start -->
    <nav class="navbar">
        <label class="logo">WaTer-SerVe <small>.com </small></label>
        <div class="navbar-collapse">
            <a href="index.php" class="nav-link">Home</a>
            <a href="billrequest.php" class="nav-link" rel="noopener noreferrer">Bill request
            </a>
            <a href="billpayment.php" class="nav-link" rel="noopener noreferrer">Bill Payment
            </a>
            <a href="history.php" class="nav-link" rel="noopener noreferrer">History</a>
            <a href="signout.php" class="nav-link" rel="noopener noreferrer">Sign out</a>
        </div>
    </nav>
    <!-- Navigation bar End -->

    <!--History code starts here -->
    <div class="request-heading">
        <h1>Bill payments</h1>
        <h2>History</h2>
    </div>
    <?php
require_once "./connect.php";
?>


    <div class="container">



        <h2>Bill history</h2>
        <a href="#" class="btn">view All</a>
    </div>

    <table>

        <thead>
            <tr>

                <th>meter number</th>
                <th>amount in Ksh</th>
                <th>payment mode</th>

            </tr>
        </thead>
        <tbody>
            <?php

$sql = 'SELECT * FROM bill_payments';
$cmd = $db->prepare($sql);
$cmd->execute();

$bill_payment = $cmd->fetchAll();
foreach($bill_payment as $bill_payments) {
  echo '
          <tr>
            
            <td>'.$bill_payments['meter_number'].'</td>
            <td>'.$bill_payments['amount_in_Ksh'].'</td>
            <td>'.$bill_payments['payment_mode'].'</td>
            
            
          </tr>

  ';
}

?>
        </tbody>

    </table>
    <br /><br />
    <hr />

    <!-- History code ends here -->
</body>

</html>