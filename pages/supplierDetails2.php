<?php
include('../db.php');
session_start();

$sup_id = $_GET['sup_id'];
$sql_supplier = "SELECT * FROM supplier WHERE sup_id='$sup_id'";
$result_supplier = $mysqli->query($sql_supplier);

// Fetch supplier information
if ($result_supplier) {
    $supplier_info = $result_supplier->fetch_assoc();
} else {
    echo "Error: " . $mysqli->error;
}

$sql_bills = "SELECT * FROM sBill WHERE sup_id='$sup_id' order by order_date desc";
$result_bills = $mysqli->query($sql_bills);
$num = mysqli_num_rows($result_bills);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Bill List</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/supplierDetails.css">
</head>

<body>
    <?php
    require 'navbar.php';
    ?>
<div class="wrapper-specific">
    <div class="left">
      <h2>Supplier Information</h2>
      
      <p>Supplier Name: <?php echo $supplier_info['sname']; ?></p>
      <p>Email: <?php echo $supplier_info['sEmail']; ?></p>
      <p>Phone No: <?php echo $supplier_info['sphone_no']; ?></p>
    </div>
  
    <div class="right">
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
              while ($row = $result_bills->fetch_assoc()) {
                  echo '<tr>';
                  echo '<td><a href="supplierDetails3.php?sBno=' . $row['sBno'] .'&grandtotal='.urlencode($row['sGrandTotal']). '">' . $row['sBno'] . '</a></td>';
                  echo '<td>' . $row['order_date'] . '</td>';
                  echo '<td>' . $row['sGrandTotal'] . '</td>';
                  echo '</tr>';
              }
              ?>
          </tbody>
      </table>
    </div>
</div>
</body>

</html>
