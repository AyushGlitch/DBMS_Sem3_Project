<?php
include '../db.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:empLogin.php");
    exit;
}

$qtyLess= false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cphone_no = $_POST['cphone_no'];
    $cname = $_POST['cname'];
    $cust_id = $_POST['cust_id'];
    $cEmail = $_POST['cEmail'];

    $j = 0;
    for ($i = 1; $i <= 5; $i++){
      $book_id = $_POST["book_id$i"];
      $qty = $_POST["qty$i"];

      $sql = "SELECT * FROM books WHERE book_id = '$book_id'";
      $result = $mysqli->query($sql);

      if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $quantity = $row['quantity'];

          if ($quantity < $qty) {
            echo "<h2>Book ID: '$book_id' is available in only '$quantity' number</h2>";
            $qtyLess= true;
            exit;
          }
        $j= $j +1;
      }
    }
  
    // Retrieve data for each book and perform necessary operations
    if($qtyLess == false){

      $sql= "INSERT into cBill(cust_id) VALUES ('$cust_id') ";
      $result = $mysqli->query($sql);
      if(!$result){
        echo "Error: " . $mysqli->error;
      }

      $sql= "SELECT cBno FROM cBill WHERE cust_id = '$cust_id' ORDER BY bill_date DESC LIMIT 1";
      $result = $mysqli->query($sql);
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $cBno = $row['cBno'];
      }
      else {
        echo "Error: " . $mysqli->error; // Log the error
      }
      
      for ($i = 1; $i <= $j; $i++) {
            $book_id = $_POST["book_id$i"];
            $qty = $_POST["qty$i"];

            if($book_id != ''){
              $sql = "SELECT * FROM books WHERE book_id = '$book_id'";
              $result = $mysqli->query($sql);

              if ($result && mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_assoc($result);
                  $price = $row['price'];
                  $quantity = $row['quantity'];

                  if ($quantity >= $qty) {
                      $sql = "UPDATE books SET quantity = quantity - '$qty' WHERE book_id = '$book_id'";
                      $result = $mysqli->query($sql);

                      if (!$result) {
                          echo "Error: " . $mysqli->error;
                      }

                      $totalPrice = $price * $qty;
                      $sql = "INSERT INTO bcBill (book_id, cBno, qty, tot_price_bc) VALUES ('$book_id', '$cBno', '$qty', '$totalPrice')";
                      $result = $mysqli->query($sql);

                      if (!$result) {
                          echo "Error: " . $mysqli->error;
                      }
                  } else {
                      echo "Error: Insufficient quantity for Book ID $book_id";
                  }
              } else {
                  echo "Error: Book not found for Book ID $book_id";
              }
            }
        }

      // Calculate grand total
      $sql = "SELECT SUM(tot_price_bc) AS grandTotal FROM bcBill WHERE cBno= '$cBno'";
      $result = $mysqli->query($sql);

      if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $grandTotal = $row['grandTotal'];

          // Update grand total in cBill table
          $sql = "UPDATE cBill SET grand_total = '$grandTotal' WHERE cBno ='$cBno'";
          $result = $mysqli->query($sql);

          if (!$result) {
              echo "Error updating cBill table: " . $mysqli->error;
          }
      } else {
          echo "Error retrieving grand total: " . $mysqli->error;
      }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Bill</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/supplierDetails.css">
</head>
<body>
  <div class="wrapper-specific">
    
<div class="left">
    <h1><span>Final Bill</span></h1>

    <p>Customer Name: <?php echo $cname; ?></p>
    <p>Customer ID: <?php echo $cust_id; ?></p>
    <p>Transaction ID: <?php echo $cBno; ?></p>
</div>
    
<div class="right">
      
    <h2>Purchased Books:</h2>
    <table>
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display purchased books
            $sql = "SELECT * FROM bcBill WHERE cBno = '$cBno'";
            $result = $mysqli->query($sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $book_id = $row['book_id'];
                    $qty = $row['qty'];
                    $totalPrice = $row['tot_price_bc'];

                    // Fetch book details
                    $bookDetails = mysqli_fetch_assoc($mysqli->query("SELECT * FROM books WHERE book_id = '$book_id'"));

                    echo "<tr>";
                    echo "<td>{$book_id}</td>";
                    echo "<td>{$bookDetails['bname']}</td>";
                    echo "<td>{$bookDetails['price']}</td>";
                    echo "<td>{$qty}</td>";
                    echo "<td>{$totalPrice}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>


<div class="left container grid-small">
    <h1><span>Grand Total</span> ₹<?php echo $grandTotal; ?></h1>
    <a class="small-btn" href="paymentSuccess.php?cust_id=<?php echo $cust_id; ?>&cBno=<?php echo $cBno; ?>">Pay Bill</a>
</div>
    <!-- Show the text for insufficient quantity if qtyLess is true -->
    <?php if ($qtyLess) : ?>
        <p style="color: red;">One or more books have insufficient quantity. Please review the details above.</p>
    <?php endif; ?>

  </div>
</body>
</html>