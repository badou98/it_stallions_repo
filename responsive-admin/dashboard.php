<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css">
    <title>Admin Panel</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>I-K-I-M-I-N-A</h1>
        </div>
        <ul>
            <li><img src="dashboard (2).png" alt="">&nbsp; <span>Dashboard</span> </li>
            <li>&nbsp;&nbsp;<span>Members</span> </li>
            <li>&nbsp;&nbsp;<span>Add Member</span> </li>
            <li>&nbsp;&nbsp;<span>Structure</span> </li>
            <li><img src="payment.png" alt="">&nbsp;<span>Income</span> </li>
            <li><img src="help-web-button.png" alt="">&nbsp; <span>Help</span></li>
            <li><img src="settings.png" alt="">&nbsp;<span>Settings</span> </li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                    <input type="text" placeholder="Search..">
                    <button type="submit"><img src="search.png" alt=""></button>
                </div>
                <div class="user">
                    <a href="#" class="btn">Add New</a>
                    <img src="notifications.png" alt="">
                    <div class="img-case">
                        <img src="user.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <?php 
        
        include_once "conn.php";

        $startDate = date("Y-m-d", strtotime("-7 days"));

        // Retrieve the number of users who contributed within the past week
        $statement = $pdo->prepare("SELECT COUNT(*) AS contributed_users FROM contribution_tbl WHERE contributed_at >= ?");
        $statement->execute([$startDate]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $contributedUsers = $result['contributed_users'];

        $statement = $pdo->query("SELECT COUNT(*) AS total_members FROM registration");
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $total = $result['total_members'];

        $statement2 = $pdo->prepare("SELECT SUM(amount) AS total_amount FROM contribution_tbl WHERE contributed_at >= ?");
        $statement2->execute([$startDate]);
        $result = $statement2->fetch(PDO::FETCH_ASSOC);
        $amount = $result['total_amount'];

        $st = $pdo->query("SELECT SUM(amount) AS amount FROM contribution_tbl");
        $result = $st->fetch(PDO::FETCH_ASSOC);
        $t_amount = $result['amount'];

        // if($total == $contributedUsers){

        //     $select = $pdo->query("SELECT * FROM account_tbl ORDER BY acc_id ASC LIMIT 1");
        //     while($row = $select->fetch(PDO::FETCH_ASSOC)){
        //         $money = $row['balance'];


        //         $updated = $money + $amount;

        //         $update = $pdo->prepare("UPDATE account_tbl SET balance = ? WHERE user_id = ?");
        //         $up_money = $update->execute([$updated,$_SESSION['user_id']]);

        //         if($up_money == true){
        //             $amount = 0;
        //             $contributedUsers = 0;

        //         }
           

        //     $row['acc_id']+=1;

                


              


        //     }
            
            
           
            
        // }

        

        

        
        ?>



        <div class="content">
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <h1><?php echo $total;?></h1>
                        <h3>Members</h3>
                    </div>
                    <div class="icon-case">
                        <img src="images/nice.png" alt="" style="width:100px"; height="60px"; >
                    </div>
                </div>
               
                <div class="card">
                    <div class="box">
                        <h1><?php echo $contributedUsers;?></h1>
                        <h3>Contributed</h3>
                    </div>
                    <div class="icon-case">
                        <img src="schools.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php echo $amount;?></h1>
                        <h3>Week Income</h3>
                    </div>
                    <div class="icon-case">
                        <img src="income.png" alt="">
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php echo $t_amount;?></h1>
                        <h3>All Income</h3>
                    </div>
                    <div class="icon-case">
                        <img src="income.png" alt="">
                    </div>
                </div>
            </div>
            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Recent Transaction</h2>
                        <a href="#" class="btn">Archive All</a>
                    </div>
                    <table>
                        <tr>
                            <th>User_id</th>
                            <th>Transactiion_type</th>
                            <th>Amount</th>
                            <th>Archive</th>
                        </tr>
                        <?php
                        
                        include "conn.php";

                        $stmt = $pdo->query("SELECT * FROM transaction_tbl ORDER BY transaction_id DESC LIMIT 7");

                        if ($stmt->rowCount() > 0) {
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows at once
                        
                            foreach ($rows as $row) {
                                echo '<tr>';
                                echo '<td>'.$row["user_id"].'</td>';
                                echo '<td>'.$row["transaction_type"].'</td>';

                                echo '<td>'.$row["amount"].'</td>';

                                
                        
                            
                                echo '</tr>';
                            }
                        } else {
                            echo 'No record found';
                        }
                        

                        
                        ?>
                     
                    </table>
                </div>
                <div class="new-students">
                    <div class="title">
                        <h2>New Members</h2>
                        <a href="#" class="btn">View All</a>
                    </div>
                    <table>
                        <tr>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>option</th>
                        </tr>
                        <?php
                        
                        include "conn.php";

                        $stmt = $pdo->query("SELECT * FROM registration ORDER BY user_id DESC LIMIT 4");

                        if ($stmt->rowCount() > 0) {
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows at once
                        
                            foreach ($rows as $row) {
                                echo '<tr>';

                                echo '<td><img src="user.png" alt=""></td>';

                                echo '<td>'.$row["full_name"].'</td>';
                                echo '<td>'.$row["telephone"].'</td>';

                                echo '<td><a href="#" class="btn">More</a></td>';

                        
                    
                        
                                echo '</tr>';
                            }
                        } else {
                            echo 'No record found';
                        }
                        

                        
                        ?>
                       
                   

                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>