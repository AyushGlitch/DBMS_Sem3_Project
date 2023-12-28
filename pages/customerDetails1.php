<?php
include('../db.php');
session_start();


if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM customer WHERE cname LIKE '%$search%'";
} else {
    $sql = "SELECT customer.*, MAX(cBill.bill_date) AS latest_bill_date FROM customer, cBill WHERE customer.cust_id = cBill.cust_id GROUP BY customer.cust_id ORDER BY latest_bill_date DESC";
}

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
    <title>Customer List</title>
    <link rel="stylesheet" href="../css/common.css">
</head>

<body>

    <?php
    require 'navbar.php';
    ?>

    <div class="wrapper">
      <div class="container">
        <form class="form-flex" action="" method="GET">
          <input class="field" type="text" placeholder="Enter Name" name="search">
          <input class="small-btn" type="submit" value="Search">
        </form>
      </div>
      <table>
          <thead>
              <tr>
                  <th>Customer ID</th>
                  <th>Customer Name</th>
                  <th>Customer Phone No</th>
                  <th>Customer Email</th>
              </tr>
          </thead>
          <tbody>
              <?php
              while ($row = $result->fetch_assoc()) {
                  echo '<tr>';
                echo '<td><a href="customerDetails2.php?cust_id=' . $row['cust_id'] . '&cname=' . urlencode($row['cname']) . '&cphone_no=' . urlencode($row['cphone_no']) . '&cEmail=' . urlencode($row['cEmail']) . '">' . $row['cust_id'] . '</a></td>';
                echo '<td>' . $row['cname'] . '</td>';
                echo '<td>' . $row['cphone_no'] . '</td>';
                echo '<td>' . $row['cEmail'] . '</td>';
  
                  echo '</tr>';
              }
              ?>              
          </tbody>
      </table>
    </div>

</body>

</html>
