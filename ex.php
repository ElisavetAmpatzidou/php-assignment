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
.age{
  display:flex;
  flex-direction: column;
}
a:link, a:visited {
  border: 2px solid black;
  background-color: #f44336;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: red;
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
#logout{
  background-color: #d020d6;
  margin-left:8%;
}
#logout:hover{
  cursor:pointer;
  background-color: #85008a;
}
</style>
</head>

<body>
<img id="wallpaper" src="./feed.jpg" alt="wallpaper">
<h1>Βοηθήστε μας να βελτιωθούμε αξιολογώντας την εμπειρία των αγορών σας από το κατάστημά μας</h1>
<?php
$nameErr = $emailErr = "";
$name = $email = $gender = $age= $feedback= $comment = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Το ονοματεπώνυμο είναι υποχρεωτικό πεδίο";
    } 
    else {
      $name = test_input($_POST["name"]);
      // check if name only contains greek and english letters and whitespace
      if (!preg_match("/^[a-zA-Z\α-ωΑ-Ω\s]*$/",$name)) {
        $nameErr = "Επιτρέπονται μόνο γράμματα και κενά"; 
      }
    }
    
    if (empty($_POST["email"])) {
      $emailErr = "Το email είναι υποχρεωτικό πεδίο";
    } 
    else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Μη έγκυρο email";
      }
    }

    if (empty($_POST["comment"])) {
      $comment = "------";
    } else {
      $comment = test_input($_POST["comment"]);
    }
     
  }
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
     }
?>

<p><span class="error">*Υποχρεωτικά πεδία</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
  <h3>Ονοματεπώνυμο:</h3> <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <h3>E-mail: </h3><input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  <h3>Φύλο:</h3>
  <div class="gender"> 
  <label><input type="radio" name="gender" value="male" required>Άνδρας</label>
  <label><input type="radio" name="gender" value="female">Γυναίκα</label>
  <label><input type="radio" name="gender" value="other">Άλλο  </label>
  </div>
  <br><br>
  <h3>Ηλικία:</h3>
  <div class="age">
  <label><input type="radio" name="age" value="18-25" required>18-25</label>
  <label><input type="radio" name="age" value="26-32">26-32</label>
  <label><input type="radio" name="age" value="33-40">33-40</label>
  <label><input type="radio" name="age" value="41-50">41-50</label>
  <label><input type="radio" name="age" value="51-60">51-60</label>
  <label><input type="radio" name="age" value="18">60+</label>
  </div>
  <br><br>
  <div class="icons">
  <h3>Επιλέξτε το εικονίδιο που ταιριάζει καλύτερα στην εμπειρία σας </h3>
  <label><input type="radio" name="feedback" value=" :) (good)" required><img id="i1" src="./happy.png"></label>
  <label><input type="radio" name="feedback" value=" :| (medium)"><img id="i2" src="./nofeeling.png"></label>
  <label><input type="radio" name="feedback" value=" :( (bad)"><img id="i3" src="./sad.png"></label>
  </div>
  <br><br>
  <h3>Σχόλια: </h3><textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  <input id="submit" type="submit" name="submit" value="Υποβολή">  
  <a href="<?php $_SERVER['PHP_SELF']; ?>">Καθαρισμός</a>
  

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])) {
      if($nameErr == "" && $emailErr == ""){
          $gender = $_POST['gender'];
          $age = $_POST['age'];
          $feedback = $_POST['feedback'];

          $servername = "localhost"; 
          $username = "root"; 
          $password = ""; 
          $dbname = "projDB1"; 
          // Create connection 
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection 
          if ($conn->connect_error) { 
            die("<p>Connection failed: " . $conn->connect_error . "</p>"); 
          } 
          $sql = "INSERT INTO customerFeedbacks (fullname, email, gender, age, feedback, comment) 
            VALUES ('$name', '$email', '$gender', '$age', '$feedback', '$comment')"; 
          if ($conn->query($sql) === TRUE) { 
            echo '<p>New record created successfully</p>'; 
          } 
          else { 
            echo "<p>Error: " . $sql . "<br>" . $conn->error ."</p>"; 
          } 
          $conn->close(); 
      }
    }
  }
?>
<br><br>
<a id="logout" href="logout.php">Logout</a>

</form>
</body>
</html>