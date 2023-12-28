<?php   
    include ('../db.php');
    session_start();
    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {  
        header("location: empLogin.php");
        exit;
    }

    $phone_no = $_GET['phone_no'];

    $sql = "SELECT * FROM employee WHERE phone_no = $phone_no";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $employee_id = $row['emp_id'];
    $password = $row['password'];
    $email = $row['email'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $addl1 = $row['addl1'];
    $addl2 = $row['addl2'];
    $city = $row['city'];
    $state = $row['state'];
    $pincode = $row['pincode'];
    $isMang = $row['manager_id'];
    if($isMang != 0){
        $manager_id = $isMang;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link rel="stylesheet" href="../css/common.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="wrapper">
      <div class="container">
        <h2>Employee Details</h2>
        <table>
            <tr>
                <th>Attribute</th>
                <th>Details</th>
            </tr>
            <tr>
                <td>Employee ID</td>
                <td><?php echo $employee_id; ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?php echo $password; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><?php echo $fname; ?></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><?php echo $lname; ?></td>
            </tr>
            <tr>
                <td>Address Line 1</td>
                <td><?php echo $addl1; ?></td>
            </tr>
            <tr>
                <td>Address Line 2</td>
                <td><?php echo $addl2; ?></td>
            </tr>
            <tr>
                <td>City</td>
                <td><?php echo $city; ?></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?php echo $state; ?></td>
            </tr>
            <tr>
                <td>Pincode</td>
                <td><?php echo $pincode; ?></td>
            </tr>
            <tr>
                <td>Manager ID</td>
                <td><?php echo $manager_id; ?></td>
            </tr>
        </table>
        <a class="small-btn" href="addEmployee.php">Go Back</a>
      </div>
    </div>
</body>

</html>