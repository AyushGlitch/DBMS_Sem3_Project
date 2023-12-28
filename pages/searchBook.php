<?php
include '../db.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <link rel="stylesheet" href="../css/common.css">
  </head>
  <body>
    <?php require 'navbar.php'?>

<div class="wrapper">
  <div class="container">
    <form class="form-flex" action="./searchBookResult.php" method="POST">
      
      <input class="field" type="text" id="bName" name="bName" placeholder="Title">
      
      <input class="small-btn" type="submit" value="Submit">
    </form>

    <p class="subtle">or</p>

    <form class="form-flex" action="./searchBookResult.php" method="POST">
      
      <input class="field" type="text" id="author" name="author" placeholder="Author">
      
      <input class="small-btn" type="submit" value="Submit">
    </form>
  </div>
</div>
  </body>
</html>
