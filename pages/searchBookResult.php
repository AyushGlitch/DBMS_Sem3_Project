<?php
include '../db.php';
session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = false;

    if (isset($_POST['bName'])) {
        $bname = $_POST['bName'];

        if (empty($bname)) {
            $error = "Please enter a book name.";
        } else {
            $sql = "SELECT * FROM books WHERE bname LIKE '%$bname%'";
            $result = $mysqli->query($sql);
            if ($result) {
                echo '<script>console.error("Result is there");</script>';
            } else {
                echo "Error: " . $mysqli->error;
            }
        }
    } else if (isset($_POST['author'])) {
        $author = $_POST['author'];

        if (empty($author)) {
            $error = "Please enter an author name.";
        } else {
            $sql = "SELECT * FROM books WHERE author LIKE '%$author%'";
            $result = $mysqli->query($sql);
            if ($result) {
                echo '<script>console.error("Result is there");</script>';
            } else {
                echo "Error: " . $mysqli->error;
            }
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
<?php require 'navbar.php'; ?>

  <div class="wrapper-specific">
  
    <div class="left">
      <div class="container">
        <form class="form-flex" action="./searchBookResult.php" method="POST">
            <input class="field" type="text" id="bName" name="bName" placeholder="Title" value="">
            <input class="small-btn" type="submit" value="Submit">
        </form>
          
        <p class="subtle">or</p>
        
        <form class="form-flex" action="./searchBookResult.php" method="POST">
            <input class="field" type="text" id="author" name="author" placeholder="Author" value="">
            <input class="small-btn" type="submit" value="Submit">
        </form>
      </div>
    </div>
    
    <div class="right">
      <h2>Search Results</h2>
      <table>
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Quantity</th>
                  <th>Price</th>
              </tr>
          </thead>
          <tbody>
              <?php
                  if ($error != "") {
                      echo '<tr>';
                      echo '<td colspan="5">' . $error . '</td>';
                      echo '</tr>';
                  }
                  if ($result) {
                      $exists = true;

                      if (mysqli_num_rows($result) == 0) {
                        echo '<tr>';
                        echo '<td colspan="5"><span>No results found.</span></td>';
                        echo '</tr>';
                      }
      
                      while ($row = $result->fetch_assoc()) {
                          echo '<tr>';
                          echo '<td>' . $row['book_id'] . '</td>';
                          echo '<td>' . $row['bname'] . '</td>';
                          echo '<td>' . $row['author'] . '</td>';
                          echo '<td>' . $row['quantity'] . '</td>';
                          echo '<td>' . $row['price'] . '</td>';
                          echo '</tr>';
                      }
                  }
              ?>
          </tbody>
      </table>
    </div>
  
  </div>

  </body>
</html>
