<?php   
include('../db.php');
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {  
  header("location:dashboard.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $sup_id = $_POST['sup_id'];
  $numOfDiffBookIDs = $_POST['numOfDiffBookIDs'];
  $discount= $_POST['discount'];

    $sql = "SELECT * FROM supplier WHERE sup_id = $sup_id";
    $result = $mysqli->query($sql);
    if(mysqli_num_rows($result) == 0){
        echo '<script>
            setTimeout(function() {
                alert("Enter valid Supplier ID...!!!");
                window.location.href = "./addBooks.php";
            });
          </script>';
        exit;
    }
  
  header("location:addBooksPage2.php?sup_id=$sup_id&numOfDiffBookIDs=$numOfDiffBookIDs&discount=$discount");
  exit;   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/common.css">
</head>

<body>
    <?php
      include 'navbar.php';
    ?>

    <div class="wrapper">
        <form class="container" action="addBooks.php" method="post">
          <input class="field" type="number" name="sup_id" id="sup_id" placeholder="Supplier ID">
          
          <input class="field" type="number" name="numOfDiffBookIDs" id="numOfDiffBookIDs" placeholder="Number of Unique books">

          <input class="field" type="number" name="discount" id="discount" placeholder="Discount by Supplier">
        
          <input class="small-btn" type="submit" value="Next">
        </form>
    </div>
</body>
</html>
