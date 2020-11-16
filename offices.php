<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>offices</title>
<link rel="stylesheet" href="classicmodels.css" type= "text/css"/>
</head>
<body>
<!--include PHP header-->
    <header><div class="header"><?php include "header.php" ?></div></header>
    <main>
<!--title and logo-->
        <div class="container">
            <img src="images/storm.jpg" style="width:100%; height:100px;">
        </div>
        <div class="title"><h2>Our offices:</h2></div>
        <div class="table">
            <?php
//declare connection variables
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "classicmodels";
        
//try to connect to database using PDO        
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//                  echo "Connected successfully";
                    $stmt = $conn->query("SELECT * FROM offices");
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    }
        
//catch exception and display error message        
                catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    }
//start building the offices table headers
                echo "<table>";
                echo "<tr><th>City</th><th>Address</th><th>Phone</th></tr>";
//set a while loop to generate office rows
//add a button with a link to access particular city office details
//link URL is structured to catch office code and city name
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
//country is included within city field
                    echo "<td>".$row['city']."<a href='officesxtra.php?id=".$row['officeCode']."&city=".$row['city']."'><button class='extrainfo'>more info</button></a><br>(".$row['country'].")</td>";
//address line 1 and line 2 merged together
                    echo "<td>".$row['addressLine1']."<br>".$row['addressLine2']."</td>";
                    echo "<td>".$row['phone']."</td>";
                    echo "</tr>";
                }
                
                echo "</table>";
                $conn = null;
            ?>
        </div>
    </main>
<!--include PHP footer-->
    <footer><div class="footer"><?php include "footer.php" ?></div></footer>
</body>