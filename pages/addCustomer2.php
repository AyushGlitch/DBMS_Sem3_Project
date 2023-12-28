<?php   
  include('../db.php');
  session_start();

  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {  
    header("location:empLogin.php");
    exit;
  }

  $cphone_no = $_GET['cphone_no'];
  $sql = "SELECT * FROM customer WHERE cphone_no = '$cphone_no'";
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();

  if ($row) {
    $cust_id = $row['cust_id'];
    $cname = $row['cname'];
    $cEmail = $row['cEmail'];
  } else {
    echo "No customer found with this phone number";
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Customer</title>
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/supplierDetails.css">
</head>

<body>
  <?php
    include 'navbar.php';
  ?>

  <div class="wrapper-specific">
  <div class="left">
    <h2>Customer Information:</h2>
    <p>Customer ID: <?php echo $cust_id; ?></p>
    <p>Name: <?php echo $cname; ?></p>
    <p>Phone Number: <?php echo $cphone_no; ?></p>
    <p>Email: <?php echo $cEmail; ?></p>
  </div>
  <div class="right ">
    <h2>New customer added successfully!</h2><br>

    <form action="./transactBillPage2.php" method="post">      
        <input type="hidden" name="cphone_no" id="cphone_no" value="<?php echo $cphone_no; ?>">
        <button class="small-btn" type="submit">Continue Bill Payment</button>
    </form>
  </div>
  </div>
</body>

</html>