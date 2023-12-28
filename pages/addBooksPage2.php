<?php   
    include('../db.php');
    session_start();
    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {  
        header("location:empLogin.php");
        exit;
    }
    
    $sup_id = $_GET['sup_id'];
    $numOfDiffBookIDs= $_GET['numOfDiffBookIDs'];
    $discount= $_GET['discount'];
    $discountFactor = ( 100- $discount) / 100;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $sql = "INSERT INTO sBill (sup_id) VALUES ($sup_id)";
        $result = $mysqli->query($sql);

        $sql = "SELECT sBno FROM sBill WHERE sup_id = $sup_id ORDER BY order_date DESC LIMIT 1";
        $result = $mysqli->query($sql);
        $row = mysqli_fetch_array($result);
        $sBno = $row['sBno'];
        
        for($i =1; $i<= $numOfDiffBookIDs; $i++){
            $book_id = $_POST["book_id$i"];
            $bname = $_POST["bname$i"];
            $author = $_POST["author$i"];
            $price = $_POST["price$i"];
            $qty = $_POST["qty$i"];

            $sql = "SELECT * FROM books WHERE book_id = $book_id";
            $result = $mysqli->query($sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $quantity = $row['quantity'];

                $sql = "UPDATE books SET quantity = quantity + '$qty' WHERE book_id = $book_id";
                $result = $mysqli->query($sql);
            }
            else{
                $sql = "INSERT INTO books (book_id, bname, author, price, quantity) VALUES ('$book_id', '$bname', '$author', '$price', '$qty')";
                $result = $mysqli->query($sql);
            }

            $sql = "INSERT INTO bsBill (sBno, book_id, qty, price, tot_price_bs) VALUES ($sBno, $book_id, $qty, $price * $discountFactor, $price*$discountFactor*$qty)";  
            $result = $mysqli->query($sql);
        }

        $sql = "SELECT SUM(tot_price_bs) AS grandTotal FROM bsBill WHERE sBno= '$sBno'";
        $result = $mysqli->query($sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $grandTotal = $row['grandTotal'];

            $sql = "UPDATE sBill SET sGrandTotal = '$grandTotal' WHERE sBno ='$sBno'";
            $result = $mysqli->query($sql);

            if ($result) {
                echo '<script>
                        setTimeout(function() {
                            alert("Book added successfully...!!! Redirecting to Dashboard...");
                            window.location.href = "./dashboard.php";
                        });
                      </script>';
            } else {
                echo "Error updating sBill table: " . $mysqli->error;
            }
        }
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


                

          <div class="container-phat">
          <!-- <div class="container"> -->
            <h2>Supplier Information</h2>
            <div class="flex-column">
              <p>ID: <?php echo $sup_id; ?></p>
              <p>Qty: <?php echo $numOfDiffBookIDs; ?></p>
            </div>
          <!-- </div> -->
                <form class="field-group-parent" action="addBooksPage2.php?sup_id=<?php echo $sup_id; ?>&numOfDiffBookIDs=<?php echo $numOfDiffBookIDs; ?>&discount=<?php echo $discount; ?>" method="post">

                    <?php
                            for ($i = 1; $i <= $numOfDiffBookIDs; $i++) {
                              echo "<div class='field-group'>";
                              
                                echo "<input class='field' type='text' name='book_id$i' id='book_id$i' placeholder='Book ID $i'>";

                                echo "<input class='field' type='text' name='bname$i' id='bname$i' placeholder='Book Name'>";

                                echo "<input class='field' type='text' name='author$i' id='author$i' placeholder='Author'>";

                                echo "<input class='field' type='number' name='qty$i' id='qty$i' placeholder='Quantity'>";

                                echo "<input class='field' type='number' name='price$i' id='price$i' placeholder='MRP'>";

                              echo "</div>";
                            }
                    ?>

                    <input class="small-btn" type="submit" value="Add">
            </form>
          </div>
        </div>
</body>
</html>
