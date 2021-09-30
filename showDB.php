<!DOCTYPE html>
<html>
    <head>
        <title>Searching results</title>
        <style>
           p>span{
            font-weight:bold;
            color:#85008a;
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
    <?php
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "projDB1"; 
        // Create connection 
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection 
        if ($conn->connect_error) { 
            die("Connection failed: " . $conn->connect_error); 
        } 
        $sql = "SELECT fullname, email, gender, age, feedback, comment FROM customerFeedbacks"; 
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) { 
            // output data of each row 
            while($row = $result->fetch_assoc()) { 
            echo " <br> <p><span>Ονοματεπώνυμο: </span>" . $row["fullname"]. " - <span>Email: </span>" . $row["email"]. " - <span>Φύλο: </span>" . $row["gender"]. " - <span>Ηλικία: </span>". $row["age"]. " - <span>Γνώμη: </span>". $row["feedback"]. " - <span>Σχόλια: </span>". $row["comment"]."</p>"; 
            } 
        }
        else { 
            echo "<p><span>0 results</span></p>"; 
        } 
        $conn->close(); 
    ?>
    <a href="./managementPage.php"> Πίσω</a>
    </body>
</html>
        