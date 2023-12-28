<?php
include '../db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $bookId = $_POST["bookId"];

  $sql = "SELECT * FROM books WHERE book_id = '$bookId'";
  $result = $mysqli->query($sql);

  if ($result && $result->num_rows > 0) {
    $bookDetails = $result->fetch_assoc();
    $bName = $bookDetails['bname'];
    $author = $bookDetails['author'];
    $price = $bookDetails['price'];
    $quantity = $bookDetails['quantity'];

    // Process form submission to update price
    if (isset($_POST["newPrice"])) {
      $newPrice = $_POST["newPrice"];
      $updateSql = "UPDATE books SET price = '$newPrice' WHERE book_id = '$bookId'";
      $updateResult = $mysqli->query($updateSql);

      if ($updateResult) {
        echo '<script>
                alert("Price updated successfully!");
                window.location.href = "./dashboard.php";
              </script>';
      } else {
        echo "Error updating price: " . $mysqli->error;
      }
    }
  } else {
    echo "No book found with this ID";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Book Price</title>
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/supplierDetails.css">
</head>
    
<body>
  <?php require 'navbar.php'?>

<div class="wrapper-specific">
  
  <div class="container left">
    <form class="form-flex" action="changeBookPrice1.php" method="POST">
      <input class="field" type="text" id="bookId" name="bookId" placeholder="Book ID" value="" required>
      <input class="small-btn" type="submit" value="Submit">
    </form>
  </div>


  <div class="right">
    <?php
      if (isset($bName)) {
        echo "<div class='grid-small'>";
          // Display book details
        echo "<div class='left'>";
          echo "<h1><span>Book Details</span></h1>
            <p>Book ID: $bookId</p>
            <p>Book Name: $bName</p>
            <p>Author: $author</p>
            <p>Quantity: $quantity</p>
            <p>Current Price: $price</p>";
        echo "</div>";
          // Form to update the price
        echo "<div class='right'>";
          echo "
            <form class='form-flex container' action='changeBookPrice1.php' method='POST'>
              <input class='field' type='number' id='newPrice' name='newPrice' value='$price' required><br>
              <input type='hidden' name='bookId' value='$bookId'>
              <input class='small-btn' type='submit' value='Update Price'>
            </form>
          ";
        echo "</div>";

        echo "</div>";
      }
    ?>
  </div>

</div>
  
</body>
</html>