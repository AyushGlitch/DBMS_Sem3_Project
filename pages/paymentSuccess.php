<?php
include '../db.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:empLogin.php");
    exit;
}

$cBno = ""; // Initialize $cBno

if (isset($_GET['cust_id']) && isset($_GET['cBno'])) {
    $cust_id = $_GET['cust_id'];
    $cBno = $_GET['cBno'];
    $sql = "UPDATE cBill SET isBillPaid = 1 WHERE cBno ='$cBno'";
    $result = $mysqli->query($sql);
    if (!$result) {
        echo "Error updating cBill table: " . $mysqli->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="../css/common.css">
</head>
<body>
  <div class="wrapper">
  <div class="container">
    <h1>Payment Success</h1>

    <?php
    echo "<p>Customer ID: $cust_id has paid bill number $cBno.</p>";
    ?>

    <form action="paymentSuccess.php" method="post">
        <input class="small-btn" type="submit" value="Go To Dashboard">
    </form>
  </div>
  </div>
</body>
</html>