<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>index</title>
<link rel="stylesheet" href="classicmodels.css" type= "text/css"/>
</head>
<body>
<!--include PHP header-->
    <header><div class="header"><?php include "header.php" ?></div></header>
    <main>
<!--title and logo-->
        <div class="container">
            <img src="images/taxi.jpg" alt="taxi_model" style="width:100%; height:400px;">
            <div class="title bottom-right"><h2>CLASSIC MODELS - everything starts small.</h2></div>
        </div>
        <div class="title"><h2>Here are our product lines:</h2></div>   
        <div class="table">
            <?php
//declare connection variables
                $servername = "localhost";
                $username = "root";
                $password = "";
        
//try to connect to database using PDO
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=classicmodels", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//(muted) echo "Connected successfully"; 
                    }
//catch exception and display error message
                catch(PDOException $e)
                    {
                echo "Connection failed: " . $e->getMessage();
                    }
        
//start building the table
                echo "<table>";
                echo "<tr><th>Product Name</th><th>Description</th></tr>";

                class TableRows extends RecursiveIteratorIterator { 
                    function __construct($it) { 
                        parent::__construct($it, self::LEAVES_ONLY); 
                    }

                    function current() {
                        return "<td>" . parent::current(). "</td>";
                    }

                    function beginChildren() { 
                        echo "<tr>"; 
                    } 

                    function endChildren() { 
                        echo "</tr>" . "\n";
                    } 
                } 
//try prepared statement
                try {
                    $stmt = $conn->prepare("SELECT productLine, textDescription FROM productlines"); 
                    $stmt->execute();

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                        echo $v;
                    }
                }
//catch exception and display error message
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $conn = null;
                echo "</table>";
            ?>
        </div>
    </main>
<!--include PHP footer-->
    <footer><div class="footer"><?php include "footer.php" ?></div></footer>
</body>