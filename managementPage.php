<!DOCTYPE html>
<html>
<head>
<title > Management Page</title>
<style>
*{
  background-color:#e8bbf2;
}
form{
  display:flex;
  flex-direction:column;
  margin: 10% 15%;
}
p>span{
  font-weight:bold;
  color:#85008a;
}
.submit{
  border: 2px solid black;
  background-color: #c65cff;
  color: white;
  padding: 16px 36px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
.submit:hover{
  cursor:pointer;
  background-color: #cd19ff;
}
a:link, a:visited {
  border: 2px solid black;
  background-color: #c65cff;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: #cd19ff;
}

#logout{
  margin:3% 32%;
}
</style>
</head>

<body>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['createdb'])) {
      $servername = "localhost"; 
      $username = "root"; 
      $password = ""; 
      $dbname = "projDB1"; 
      // Create connection 
      $conn = new mysqli($servername, $username, $password); 
      // Check connection 
      if ($conn->connect_error) { 
      die("Connection failed: " . $conn->connect_error); 
      } 
      // Create database 
      $sql = "CREATE DATABASE projDB1"; 
      if ($conn->query($sql) === TRUE) { 
      echo "Η βάση δεδομένων δημιουργήθηκε επιτυχώς"; 
      } else { 
      echo "Η βάση αυτή υπάρχει ήδη"; 
      } 
      $conn->close(); 
      // Create connection 
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection 
      if ($conn->connect_error) { 
      die("Connection failed: " . $conn->connect_error); 
      } 
      // sql to create table 
      $sql = "CREATE TABLE customerFeedbacks (  
      fullname VARCHAR(90) NOT NULL, 
      email VARCHAR(50), 
      gender VARCHAR(10),
      age VARCHAR(5),
      feedback VARCHAR(40),
      comment VARCHAR(300)
      )";
      $conn->query($sql);
      $conn->close();
    }

  } 
?>
<form  method="post">
<input class="submit" type="submit" name="createdb" value="Δημιουργία Βάσης Δεδομένων">  
<a href="./showDB.php"> Προβολή Στοιχείων</a>
<a href="./searchForm.php"> Αναζήτηση</a>
<a id="logout" href="logout.php">Logout</a>
</form>


</body>
</html>