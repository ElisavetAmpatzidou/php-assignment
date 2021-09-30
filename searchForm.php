<!DOCTYPE html>
<html>
<head>
<title > Communication form </title>
<style>
*{
  background-color:#e8bbf2;
}
h1{
  color:#85008a;
  text-align:center;
  width:70%;
  margin-left:15%;
}
p{
 font-weight:bold;
 color:#85008a;
}
#wallpaper{
  width:70%;
  margin-left:15%
}
.error {color: #FF0000;}
.gender{
  display:flex;
  flex-direction: column;
}
#submit{
  border: 2px solid black;
  background-color: #3399ff;
  color: white;
  padding: 16px 36px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
#submit:hover{
  cursor:pointer;
  background-color: #0073e6;
}
#i1{
  width: 50px;
  height:50px;
}
#i2{
  width:55px;
  height: 55px;
}
#i3{
  width:50px;
  height:50px;
}
form{
  margin-left:35%;
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
</style>
</head>

<body>
<img id="wallpaper" src="./search.jpg" alt="wallpaper">
<h1>Συμπληρώστε κάποιο από τα φίλτρα για να πραγματοποιήσετε αναζήτηση</h1>
<?php

$name = $nameErr = $feedback = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["name"]) {
      $name = test_input($_POST["name"]);
      // check if name only contains greek and english letters and whitespace
      if (!preg_match("/^[a-zA-Z\α-ωΑ-Ω\s]*$/",$name)) {
        $nameErr = "Επιτρέπονται μόνο γράμματα και κενά"; 
      }
    }
     
  }
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
     }
?>

<form method="post" action="searchResults.php">
  <h3>Αναζήτηση Ονομάτων:</h3> <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error"> <?php echo $nameErr;?></span>
  <br><br>

  <div class="icons">
  <h3>Αναζήτηση Αξιολογήσεων: </h3>
  <label><input type="radio" name="feedback" value=" :) (good)" ><img id="i1" src="./happy.png"></label>
  <label><input type="radio" name="feedback" value=" :| (medium)"><img id="i2" src="./nofeeling.png"></label>
  <label><input type="radio" name="feedback" value=" :( (bad)"><img id="i3" src="./sad.png"></label>
  </div>
  <br><br>
  <input id="submit" type="submit" name="submit" value="Επιλογή">  
</form>
<a href="./managementPage.php"> Πίσω</a>
</body>
</html>