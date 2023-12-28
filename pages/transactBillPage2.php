<?php
  include '../db.php';
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true){  
    header("location:empLogin.php");
    exit;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cphone_no = $_POST['cphone_no'];

    $correctCphone_no= true;                                        
    if ($cphone_no == ""){
      $correctCphone_no= false;
    }

    if($correctCphone_no == true){
      $sql = "SELECT * FROM customer WHERE cphone_no = '$cphone_no'";
      $result = $mysqli->query($sql);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $cname = $row['cname'];
        $cust_id = $row['cust_id'];
        $cEmail = $row['cEmail'];  
      }
      else {
        header("location: addCustomer.php?cphone_no=$cphone_no");
        exit;
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/supplierDetails.css">
  </head>
  <body>
    <?php require 'navbar.php'?>


    <div class="wrapper">
      
      <form class="wrapper-specific" action="./transactBillPage3.php" method="POST">

      <div class="left">
        <h1><span>Customer Details</span></h1>
        
        <label class="subtle" for="cphone_no">Customer Phone:</label>
        <input class="field" type="text" id="cphone_no" name="cphone_no" value="<?php echo $cphone_no; ?>" readonly>
        
        <label class="subtle" for="cust_id">Customer ID:</label>
        <input class="field" type="text" id="cust_id" name="cust_id" value="<?php echo $cust_id; ?>" readonly>
        
        <label class="subtle" for="cname">Customer Name:</label>
        <input class="field" type="text" id="cname" name="cname" value="<?php echo $cname; ?>" readonly>
        
        <label class="subtle" for="cEmail">Customer Email:</label>
        <input class="field" type="text" id="cEmail" name="cEmail" value="<?php echo $cEmail; ?>" readonly>
      </div>
        
      <div class="field-group-parent right flex-center">
        
        <div class="field-group">
          <input class="field" type="text" id="book_id1" name="book_id1" placeholder="Enter Book ID">
          <input class="field" type="text" id="qty1" name="qty1" placeholder="Enter Quantity">
        </div>
  
        <div class="field-group">
          <input class="field" type="text" id="book_id2" name="book_id2" placeholder="Enter Book ID">
          <input class="field" type="text" id="qty2" name="qty2" placeholder="Enter Quantity">
        </div>
  
        <div class="field-group">
          <input class="field" type="text" id="book_id3" name="book_id3" placeholder="Enter Book ID">
          <input class="field" type="text" id="qty3" name="qty3" placeholder="Enter Quantity">
        </div>
  
        <div class="field-group">
          <input class="field" type="text" id="book_id4" name="book_id4" placeholder="Enter Book ID">
          <input class="field" type="text" id="qty4" name="qty4" placeholder="Enter Quantity">
        </div>
  
        <div class="field-group">
          <input class="field" type="text" id="book_id5" name="book_id5" placeholder="Enter Book ID">
          <input class="field" type="text" id="qty5" name="qty5" placeholder="Enter Quantity">
        </div>
        
        <input class="small-btn" type="submit" value="Submit">
        
      </div>
        
      </form>
      
    </div>
    
  </body>
</html>
