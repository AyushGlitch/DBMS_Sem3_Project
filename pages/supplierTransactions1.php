<?php

  include ('../db.php');
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true){  
    header("location:empLogin.php");
    exit;
  }
  // $sql = "SELECT * from supplier where sup_id in (select sup_id from sBill order by order_date desc)";


    $sql = "SELECT sBill.*, supplier.* FROM sBill, supplier WHERE sBill.sup_id = supplier.sup_id ORDER BY sBill.order_date DESC";

  $exists= false;
  $result = $mysqli->query($sql);
  if ($result){
    $exists = true;
  }
  $num=mysqli_num_rows($result);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier List</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/supplierDetails.css">
</head>

<body>

    <?php
    include 'navbar.php';
    ?>

    <div class="wrapper">

        <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Supplier ID</th>
                <th>Supplier Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Order Received At</th>
            </tr>
        </thead>
        <tbody>
        
        <?php
            if ($exists) {
                
              while ($row = $result->fetch_assoc()) {
                  echo "
                      <tr>
                          <td><a href='supplierTransactions2.php?sBno={$row['sBno']}&grandtotal=" . urlencode($row['sGrandTotal']) . "'>{$row['sBno']}</a></td>
                          <td>{$row['sup_id']}</td>
                          <td>{$row['sname']}</td>
                          <td>{$row['sphone_no']}</td>
                          <td>{$row['sEmail']}</td>
                          <td>{$row['sAddl1']} {$row['sAddl2']} {$row['sState']} {$row['sCity']}</td>
                          <td>{$row['order_date']}</td>
                      </tr>
                  ";
              }

            
                echo "
                        </tbody>
                    </table>
                ";
            } else {
                echo '<p>No data available.</p>';
            }
        ?>
        
    </div>
</body>
</html>
