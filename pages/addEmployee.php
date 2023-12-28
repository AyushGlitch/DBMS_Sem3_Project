<?php   
  include ('../db.php');
  session_start();

  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {  
    header("location: empLogin.php");
    exit;
  }

  $password = strval(rand(10000, 99999));

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone_no = $_POST['phone_no'];
    $addl1 = $_POST['addl1'];
    $addl2 = $_POST['addl2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $manager_id = isset($_POST['manager_id']) && $_POST['manager_id'] !== '' ? $_POST['manager_id'] : 0;
    $email = $_POST['email'];

    $sql = "INSERT INTO employee (fname, lname, phone_no, manager_id, addl1, addl2, city, state, pincode, password, email) VALUES (
      '$fname',
      '$lname',
      '$phone_no',
      '$manager_id',
      '$addl1',
      '$addl2',
      '$city',
      '$state',
      '$pincode',
      '$password',
      '$email'
    );";

    $result = $mysqli->query($sql);

    if (!$result) {
      $error_message = "Error updating employee table: " . $mysqli->error;
      // Optionally, you can log the error or handle it in another way
    } else {
      header("location: addEmployee2.php?phone_no=$phone_no");
      exit;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/supplierDetails.css">
    <link rel="stylesheet" href="../css/addEmployee.css">
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="wrapper-specific">
      <div class="left flex-center">
        <h1><span>Add New Employee</span></h1>
      </div>
      <div class="right">
        <div class="container">
      <form action="addEmployee.php" method="post">
        <input class="field" type="text" name="fname" id="fname" placeholder="First Name" required>

        <input class="field" type="text" name="lname" id="lname" placeholder="Last Name" required>

        <input class="field" type="text" name="phone_no" id="phone_no" placeholder="Phone" required>

        <input class="field" type="text" name="addl1" id="addl1" placeholder="Address Line 1" required>

        <input class="field" type="text" name="addl2" id="addl2" placeholder="Address Line 2">

        <input class="field" type="text" name="city" id="city" placeholder="City" required>

        <input class="field" type="text" name="state" id="state" placeholder="State" required>

        <input class="field" type="text" name="pincode" id="pincode" placeholder="Pincode" required>

        <input class="field" type="number" name="manager_id" id="manager_id" placeholder="Manager ID">

        <input class="field" type="email" name="email" id="email" placeholder="Email" required>

        <input class="small-btn" type="submit" value="Add Employee">
      </form>
        </div>
      </div>
    </div>
  </body>
</html>