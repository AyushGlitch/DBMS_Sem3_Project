<?php

include('../db.php');
session_start();

$cphone_no=$_GET['cphone_no'];
$cEmail=$_GET['cEmail'];
$cname=$_GET['cname'];
$cust_id = $_GET['cust_id'];
$sql = "SELECT * FROM cBill WHERE cust_id='$cust_id'";

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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>

    <?php
    require 'navbar.php';
    ?>

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
                echo $cust_id. ' '. $cname.' ' .$cEmail. ' '. $cphone_no   .'<br><br>';
            while ($row = $result->fetch_assoc()) {
              if($row['isBillPaid']==1){
                echo '<tr>';
                echo '<td><a href="customerDetails3.php?cBno=' . $row['cBno'] . '">' . $row['cBno'] . '</a></td>';
                echo '<td>' . $row['bill_date'] . '</td>';
                echo '<td>' . $row['grand_total'] . '</td>';
                echo '<td>' . $row['isBillPaid'] . '</td>';
                echo '</tr>';
            }}
            ?>
        </tbody>
    </table>

</body>

</html>
