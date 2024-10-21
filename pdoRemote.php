<?php
  $serverName = 'asobutmc.com';
  $username = 'admin';
  $password = 'tsIY73P8Wt';
  $dbName = 'asobutmc_acougue';
  $tableName = 'viewDigitalDisplay';
  
  // create the connection
  try{
    $pdoRemote = new PDO("mysql:host={$serverName};dbname={$dbName}", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result['dbConnectionStatus']="Connected successfully";
  } catch(PDOException $e){
    $result['dbConnectionStatus']="Connection failed: " . $e->getMessage();
  }
?>