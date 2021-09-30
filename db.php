<?php
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "projDB2"; 
    // Create connection 
    $conn = new mysqli($servername, $username, $password);
    // Check connection 
    if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
    } 
    // Create database 
    $sql = "CREATE DATABASE projDB2"; 
    $conn->query($sql);
    $conn->close(); 
    // Create connection 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection 
    if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
    } 
    
    // sql to create table 
    $sql = "CREATE TABLE IF NOT EXISTS users (
      id int(11) NOT NULL AUTO_INCREMENT,
      username varchar(50) NOT NULL UNIQUE,
      email varchar(50) NOT NULL,
      password varchar(50) NOT NULL,
      create_datetime datetime NOT NULL,
      PRIMARY KEY (`id`)
      )";
      $conn->query($sql);
    
    $conn->close();

    $con = mysqli_connect("localhost","root","","projdb2");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
