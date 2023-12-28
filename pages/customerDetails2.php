<?php

include('../db.php');
session_start();

$cphone_no=$_GET['cphone_no'];
$cEmail=$_GET['cEmail'];
$cname=$_GET['cname'];
$cust_id = $_GET['cust_id'];
$sql = "SELECT * FROM cBill WHERE cust_id='$cust_id' order by bill_date desc";

$result = $mysqli->query($sql);
$num = mysqli_num_rows($result);

if ($result) {
    $exists = true;
    echo '<script>console.error("Result is there");</script>';
} else {
    echo "Error: " . $mysqli->error;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Bill List</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/supplierDetails.css">
</head>

<body>

    <?php
    require 'navbar.php';
    ?>
<div class="wrapper-specific">

    <div class="left">
      <h2>Customer Information</h2>
      
      <p>ID: <?php echo $cust_id; ?></p>
      <p>Name: <?php echo $cname; ?></p>
      <p>Email: <?php echo $cEmail; ?></p>
      <p>Phone: <?php echo $cphone_no; ?></p>
    </div>

  <div class="right">
    <h2>Customer Bill List</h2>

    <table>
        <thead>
            <tr>
                <th>Bill No</th>
                <th>Bill Date</th>
                <th>Bill Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
              while ($row = $result->fetch_assoc()) {
                if($row['isBillPaid']==1){
                  echo '<tr>';
                  echo '<td><a href="customerDetails3.php?cBno=' . $row['cBno'] . '&grand_total='.urlencode($row['grand_total']).'">' . $row['cBno'] . '</a></td>';
                  echo '<td>' . $row['bill_date'] . '</td>';
                  echo '<td>' . $row['grand_total'] . '</td>';
                  echo '<td>' . $row['isBillPaid'] . '</td>';
                  echo '</tr>';
                }
              }
            ?>
        </tbody>
    </table>
  </div>
</div>
</body>

</html>
