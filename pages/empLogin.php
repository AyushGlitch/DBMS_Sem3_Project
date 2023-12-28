<?php  
  session_start();
  include ('../db.php');
  $login=false; 
  $showalert=false;
  $showerror=false;

  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $emp_id=$_POST['emp_id'];
    $password=$_POST['password'];

    $sql="select * from employee where emp_id='$emp_id' and password='$password'"; 

    $result = $mysqli->query($sql);
    $num=mysqli_num_rows($result);

    if($num==1){
        $login=true;
        $_SESSION['loggedin']=true;
        $_SESSION['emp_id']=$emp_id;        
        $_SESSION['is_mgr'] = 0;

        $row = $result->fetch_assoc();        
        if($row['manager_id'] == 0){
          $_SESSION['is_mgr'] = 1;
        }

        $_SESSION['fname']= $row['fname'];
        $_SESSION['lname']= $row['lname'];

        header("location: dashboard.php?emp_id=$emp_id");
        exit;
    }
    else{
        $showerror="Invalid credentials";
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
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

    <?php
      include 'navbar.php' 
    ?>

    <div class="container-specific">
      <div class="main-container">
        
        <div class="welcome">
            <h1>Welcome to BookSphere</h1>
            <p>Embark on a literary journey with BookSphere, where every page turns into a new adventure. Discover, indulge, and bring the magic of books to your doorstep.</p>
        </div>

        <div class="login-container">
          <h1>Login</h1>
          <form action="empLogin.php" method="post">
            <input class="field" type="number" name="emp_id" id="emp_id"  placeholder="Employee ID">
            <input class="field" type="password" name="password" id="password" placeholder="Password">
            <button class="btn-login" type="submit">Login</button>
          </form>
        </div>
        
      </div>
    </div>

</body>
</html>






