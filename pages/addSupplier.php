<?php   
  include ('../db.php');
  session_start();

  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {  
    header("location: empLogin.php");
    exit;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sname = $_POST['sname'];
    $sphone_no = $_POST['sphone_no'];
    $sAddl1 = $_POST['sAddl1'];
    $sAddl2 = $_POST['sAddl2'];
    $sCity = $_POST['sCity'];
    $sState = $_POST['sState'];
    $sPincode = $_POST['sPincode'];
    $sEmail = $_POST['sEmail'];

    $sql = "INSERT INTO supplier (sname, sphone_no, sAddl1, sAddl2, sCity, sState, sPincode, sEmail) VALUES (
      '$sname',
      '$sphone_no',
      '$sAddl1',
      '$sAddl2',
      '$sCity',
      '$sState',
      '$sPincode',
      '$sEmail'
    );";

    $result = $mysqli->query($sql);

    if (!$result) {
      $error_message = "Error updating supplier table: " . $mysqli->error;
      // Optionally, you can log the error or handle it in another way
    } else {
        echo '<script>
            alert("New Supplier added successfully...!!! Redirecting to Dashboard...");
                window.location.href = "./dashboard.php";
            ;
          </script>';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/supplierDetails.css">
    <link rel="stylesheet" href="../css/addEmployee.css">
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="wrapper-specific">
      <div class="left flex-center">
        <h1><span>Add New Supplier</span></h1>
      </div>
      <div class="right">
        <div class="container">
            
      <form action="addSupplier.php" method="post">
        <input class="field" type="text" name="sname" id="sname" placeholder="Supplier Name" required>

        <input class="field" type="text" name="sphone_no" id="sphone_no" placeholder="Phone" required>

        <input class="field" type="text" name="sAddl1" id="sAddl1" placeholder="Address Line 1" required>

        <input class="field" type="text" name="sAddl2" id="sAddl2" placeholder="Address Line 2">

        <input class="field" type="text" name="sCity" id="sCity" placeholder="City" required>

        <input class="field" type="text" name="sState" id="sState" placeholder="State" required>

        <input class="field" type="text" name="sPincode" id="sPincode" placeholder="Pincode" required>

        <input class="field" type="email" name="sEmail" id="sEmail" placeholder="Email" required>

        <input class="small-btn" type="submit" value="Add Supplier">
      </form>
        </div>
      </div>
    </div>
  </body>
</html>