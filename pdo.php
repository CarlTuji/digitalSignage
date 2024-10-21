<?php
  $serverName = 'localhost';
  $username = 'digitalDisplay';
  $password = '$=K3vGat6IEL';
  
  // create the connection
  try{
    $pdo = new PDO("mysql:host={$serverName};dbname=digitalDisplay", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result['dbConnectionStatus']="Connected successfully";
  } catch(PDOException $e){
    $result['dbConnectionStatus']="Connection failed: " . $e->getMessage();
  }
?>