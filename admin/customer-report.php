<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/Style.css" type="text/css" />
    <link rel="icon" type="image/png" href="image\waterlogo.jpg">
    <title>Reports</title> 
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
                    <input type="text" placeholder="Search">
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
            <div class="content-2">
                <div class="new-students">
                    <div class="title">
                        <h2>Customer Reports</h2>
                        <a href="#" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                            <th>id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Issue</th>
                                <th>Subject</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "./connect.php";

                            // Handle form submission to add admin response
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                if (isset($_POST['issue_id']) && isset($_POST['admin_response'])) {
                                    $issueId = htmlspecialchars($_POST['issue_id']);
                                    $adminResponse = htmlspecialchars($_POST['admin_response']);

                                    // Update the report with admin response
                                    $sql = 'UPDATE report SET admin_response = :admin_response, response_timestamp = NOW() WHERE id = :id';
                                    $stmt = $db->prepare($sql);
                                    $stmt->bindParam(':admin_response', $adminResponse);
                                    $stmt->bindParam(':id', $issueId);
                                    $stmt->execute();
                                }
                            }

                            // Fetch and display reports
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
                                        <td>'.$report['issue'].'</td>
                                        <td>'.$report['subject'].'</td>
                                        <td>
                                            <form action="customer-report.php" method="POST">
                                                <input type="hidden" name="issue_id" value="'.$report['id'].'">
                                                <textarea name="admin_response" placeholder="Type your response"></textarea>
                                                <button type="submit"><i class="fas fa-reply"></i> Respond</button>
                                            </form>
                                            <a href="delete-report.php?id='.$report['id'].'"><i class="fas fa-trash-alt"></i></a>
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
</body>
</html>
