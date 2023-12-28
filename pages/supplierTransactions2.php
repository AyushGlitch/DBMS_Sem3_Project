<?php
include('../db.php');
session_start();

$grandtotal = $_GET['grandtotal'];
$sBno = $_GET['sBno'];
$sql = "SELECT bsBill.*, books.bname FROM bsBill JOIN books ON bsBill.book_id = books.book_id WHERE sBno='$sBno'";

$result = $mysqli->query($sql);
$num = mysqli_num_rows($result);

if ($result) {
    $exists = true;
    echo '<script>console.error("Result is there")</script>';
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
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/supplierDetails.css">
</head>

<body>

    <?php
    require 'navbar.php';
    ?>
<div class="wrapper-specific">
  <div class="left flex-center">
      <h1><span>Grand Total</span> ₹<?php echo $grandtotal ?> </h1>
  </div>
  <div class="right">
      <h2>Supplier Bill List</h2>
      <table>
          <thead>
              <tr>
                  <th>Supplier Bill Number</th>
                  <th>Book Name</th>
                  <th>Book ID</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Bill Amount</th>
              </tr>
          </thead>
          <tbody>
              <?php
  while ($row = $result->fetch_assoc()) {
      echo "
          <tr>
              <td>{$row['sBno']}</td>
              <td>{$row['bname']}</td>
              <td>{$row['book_id']}</td>
              <td>{$row['price']}</td>
              <td>{$row['qty']}</td>
              <td>{$row['tot_price_bs']}</td>
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
