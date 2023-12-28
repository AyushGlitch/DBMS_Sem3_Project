<?php 
  include('../db.php');

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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

    <?php
    include 'navbar.php';
    ?>

  <div class="wrapper-specific"
    <div class="container-specific">
      
      
      <header>
          <h1><span>Welcome</span> <?php echo $_SESSION['fname'], " ", $_SESSION['lname'] ?></h1>
      </header>
  
      <div class="grid-links">
        <a href="supplierDetails1.php" class="btn">Supplier Details</a>
        <a href="supplierTransactions1.php" class="btn">Supplier Transactions</a>
        <a href="customerDetails1.php" class="btn">Customer Details</a>
        <a href="customerTransactions1.php" class="btn">Customer Transactions</a>   
        <a href="addBooks.php" class="btn">Add Books</a>
        <a href="transactBillPage1.php" class="btn">Transact A Bill</a>
        <a href="changeBookPrice1.php" class="btn">Change Book Price</a>
  
        <?php
          if ($_SESSION['is_mgr'] == 1) {
              echo '<a href="addEmployee.php" class="btn">Add Employee</a>';
              echo '<a href="addSupplier.php" class="btn">Add Supplier</a>';
          }
        ?>
      </div>
            
    </div>
  </div>

</body>

</html>
