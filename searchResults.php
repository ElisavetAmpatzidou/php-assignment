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
      
        $conn= new mysqli("localhost","root","","projDB1");

        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $results= true;
        if(!empty($_POST["name"])){
            if(!empty($_POST["feedback"])){
                $result = mysqli_query($conn, "SELECT * FROM customerfeedbacks
                WHERE fullname LIKE '%{$_POST['name']}%' AND feedback LIKE '{$_POST['feedback']}'");
            }
            else{
                $result = mysqli_query($conn, "SELECT * FROM customerfeedbacks
                WHERE fullname LIKE '%{$_POST['name']}%' ");
            }

        }
        else{
            if(!empty($_POST["feedback"])){
                $result = mysqli_query($conn, "SELECT * FROM customerfeedbacks
                WHERE feedback LIKE '{$_POST['feedback']}'");
            }
            else{
                echo '<p>Δεν έχετε συμπληρώσει στοιχεία σε κανένα από τα φίλτρα..</p>';
                $results=false;
            }
        }
        $flag=true;                        
        if($results){
            while ($row = mysqli_fetch_array($result))
            {
                echo " <br> <p><span>Ονοματεπώνυμο: </span>" . $row["fullname"]. " - <span>Email: </span>" . $row["email"]. " - <span>Φύλο: </span>" . $row["gender"]. " - <span>Ηλικία: </span>". $row["age"]. " - <span>Γνώμη: </span>". $row["feedback"]. " - <span>Σχόλια: </span>". $row["comment"]."</p>"; 
                $flag=false;
            }
        }
        if($flag){
            echo '<p>No results :( </p>';
         }

        mysqli_close($conn);
    ?>
    <a href="./managementPage.php"> Πίσω</a>
    </body>

</html>
