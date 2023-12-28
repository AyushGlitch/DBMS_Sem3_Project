<?php

include('../db.php');
session_start();

$sql = "SELECT cBill.*, customer.cname, customer.cust_id FROM cBill, customer WHERE cBill.cust_id = customer.cust_id ORDER BY cBill.bill_date DESC";

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

<div class="wrapper">
    <h2>Customer Bill List</h2>

    <table>
        <thead>
            <tr>
                <th>Bill No</th>
                <th>Customer Name</th>
                <th>Customer ID</th>
                <th>Bill Date</th>
                <th>Bill Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                if ($row['isBillPaid'] == 1) {
                    echo "<tr>
                        <td><a href=\"customerTransactions2.php?cBno={$row['cBno']}&cust_id={$row['cust_id']}&cname=" . urlencode($row['cname']) . "\">{$row['cBno']}</a></td>
                        <td>{$row['cname']}</td>
                        <td>{$row['cust_id']}</td>
                        <td>{$row['bill_date']}</td>
                        <td>{$row['grand_total']}</td>
                        <td>{$row['isBillPaid']}</td>
                    </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>
</body>

</html>
