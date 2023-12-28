<?php
  include '../db.php';
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true){  
    header("location:empLogin.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <link rel="stylesheet" href="../css/common.css">
  </head>
  <body>
    <?php require 'navbar.php'?>

    <div class="wrapper">
      <div class="container">
        <form class="form-flex" action="./transactBillPage2.php" method="POST">
          <input class="field" type="text" id="cphone_no" name="cphone_no" placeholder="Customer Phone no."><br>
          <input class="small-btn" type="submit" value="Submit">
        </form> 
      </div>
    </div>
  </body>
</html>
