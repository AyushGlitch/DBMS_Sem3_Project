<?php   
  include('../db.php');
  session_start();

  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {  
    header("location:empLogin.php");
    exit;
  }

  $cphone_no = $_GET['cphone_no'];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cname = $_POST['cname'];
    $cEmail = $_POST['cEmail'];

    // Use single quotes around values in the SQL query
    $sql = "INSERT INTO customer (cname, cphone_no, cEmail) VALUES ('$cname', '$cphone_no', '$cEmail')";
    $result = $mysqli->query($sql);

    if ($result) {
      header("location: addCustomer2.php?cphone_no=$cphone_no");
    } else {
      echo "Error updating customer table: " . $mysqli->error;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Customer</title>
  <link rel="stylesheet" href="../css/common.css">
</head>

<body>
  <?php
    include 'navbar.php';
  ?>

  <div class="wrapper">
    <div class="container">
      <form action="addCustomer.php?cphone_no=<?php echo $cphone_no; ?>" method="post">
        <input class="field" type="text" name="cname" id="cname" placeholder="Customer Name" required><br><br>
        <input class="field" type="email" name="cEmail" id="cEmail" placeholder="Customer Email" required><br><br>
        <input class="small-btn" type="submit" value="Add Customer">
      </form>
    </div>
  </div>
</body>

</html>