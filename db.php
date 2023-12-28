<?php
$hostname="aws.connect.psdb.cloud";
$dbName = "bloggo";
$username = "9sui383dcq1twfffw0dp";
$password = "pscale_pw_n1NRKhoAE4WvBWrvKagkQXthJIcfSf6m55Oj1B6Ti8v";
// $port = $_ENV['PORT'];
$ssl = "/etc/ssl/certs/ca-certificates.crt";

// Set SSL cert and open connection to the MySQL server
$mysqli = mysqli_init();
$mysqli->ssl_set(NULL, NULL, $ssl, NULL, NULL);
$mysqli->real_connect($hostname, $username, $password, $dbName);

if ($mysqli->connect_error) {
  
} else {
    
}
?>
