<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>offices extra info</title>
<link rel="stylesheet" href="classicmodels.css" type= "text/css"/>
</head>
<body>
<!--include PHP header-->
    <header><div class="header"><?php include "header.php" ?></div></header>
    <main>
<!--title and logo-->
        <div class="container">
            <img src="images/car3.jpg" style="width:100%; height:100px;">
        </div>
        <div class="table">
            <?php
//declare connection variables
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "classicmodels";
                $officecode = $_GET['id'];
                $officename = $_GET['city'];
        
//try to connect to database using PDO        
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//                  echo "Connected successfully";
                    $stmt = $conn->query("SELECT * FROM employees WHERE officeCode = '$officecode'");
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    }
//catch exception and display error message  
                catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    }

//heading that catches the proper office city
                echo "<div class='title'><h3>Employees for our ".$officename." office:</h3></div>";
//start building the table
                echo "<table id='officex'>";
                echo "<tr><th>Name</th><th>Job Title</th><th>E-mail</th></tr>";
                
//set a while loop to generate table rows with specific office employees
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>".$row['lastName'].", ".$row['firstName']."</td>";
                    echo "<td>".$row['jobTitle']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "</tr>";
                }
                
                echo "</table>";
                $conn = null;
            ?>
        </div>
    </main>
<!--no footer here, as it is a detail sub-page to display-->
</body>