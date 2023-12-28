<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>
<div class="nav">
  <div class="nav-left">
    <p>Book<span>Sphere</span></p>
  </div>
  <nav>
    <ul>
      
      <?php
        if (!isset($_SESSION['emp_id'])) {
            echo '<li><a href="./empLogin.php">Employee Login </a></li>';
        }
        ?>
      
        <?php
        if (isset($_SESSION['emp_id'])) {
            $emp_id = $_SESSION['emp_id'];
            echo "<li><a href='./logout.php'>Logout</a></li>";
            echo "<li><a href='./dashboard.php?emp_id=$emp_id'>Dashboard</a></li>";
        }
      ?>
    
      <li><a href="./searchBook.php">Search Book</a></li>
  
    </ul>
  </nav>
</div>

</body>
</html>