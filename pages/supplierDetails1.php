<?php

  include ('../db.php');
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true){  
    header("location:empLogin.php");
    exit;
  }
  $sql = "SELECT supplier.*
FROM supplier
LEFT JOIN sBill ON supplier.sup_id = sBill.sup_id
GROUP BY supplier.sup_id
ORDER BY MAX(sBill.order_date) DESC";



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

        <?php
        if ($exists) {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Supplier ID</th>';
            echo '<th>Supplier Name</th>';
            echo '<th>Phone Number</th>';
            echo '<th>Email</th>';
            echo '<th>Address</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
               echo '<td><a href="supplierDetails2.php?sup_id=' . $row['sup_id'] . '">' . $row['sup_id'] . '</a></td>';
                echo '<td>' . $row['sname'] . '</td>';
                echo '<td>' . $row['sphone_no'] . '</td>';
                echo '<td>' . $row['sEmail'] . '</td>';
                echo '<td>' . $row['sAddl1'] . ' ' . $row['sAddl2'] . ' ' . $row['sState'] . ' ' .
                     $row['sCity'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No data available.</p>';
        }
        ?>

    </div>
</body>
</html>
