<?php

include('../db.php');
session_start();

$sup_id = $_GET['sup_id'];
$sql = "SELECT * FROM sBill WHERE sup_id='$sup_id'";

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
    <title>Supplier Bill List</title>
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

    <h2>Supplier Bill List</h2>

    <table>
        <thead>
            <tr>
                <th>Bill No</th>
                <th>Bill Date</th>
                <th>Bill Amount</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><a href="customerBooksPurchased.php?cBno=' . $row['sBno'] . '">' . $row['sBno'] . '</a></td>';
                echo '<td>' . $row['order_date'] . '</td>';
                echo '<td>' . $row['sGrandTotal'] . '</td>';
                
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

</body>

</html>
