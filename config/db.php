<?php
    $pdo = null;	
try {
    $pdo = new PDO('mysql:host=localhost;dbname=santa;charset=utf8', 'paul','archer');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   
  } catch (PDOException $e) {
    $error = 'Error '.$e->getMessage();
    include  ROOT.'/../templates/output.php'; exit();
    
  }
