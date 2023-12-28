<?php

include('../db.php');
session_start();


$id=$_GET['cust_id'];
$name=$_GET['cname'];
$cBno = $_GET['cBno'];
$sql = "SELECT * FROM bcBill WHERE cBno='$cBno'";

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

    <p>ID: <?php echo $id; ?></p>
    <p>Name: <?php echo $name; ?></p>
    <p>cBono: <?php echo $cBno; ?></p>
  </div>

  <div class="right">
    <h2>Customer Bill List</h2>

    <table>
        <thead>
            <tr>
                <th>Book Id</th>
                <th>Quantity</th>
                <th>Bill Amount</th>

            </tr>
        </thead>
        <tbody>
            <?php
while ($row = $result->fetch_assoc()) {
    echo "
        <tr>
            <td>{$row['book_id']}</td>
            <td>{$row['qty']}</td>
            <td>{$row['tot_price_bc']}</td>
        </tr>
    ";
}

            ?>
        </tbody>
    </table>
</div>
</div>
</body>

</html>
