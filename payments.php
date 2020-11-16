<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>payments</title>
<link rel="stylesheet" href="classicmodels.css" type= "text/css"/>
</head>
<body>
<!--include PHP header-->
    <header><div class="header"><?php include "header.php" ?></div></header>
    <main>
<!--title and logo-->
        <div class="container">
            <img src="images/car4.jpg" style="width:100%; height:100px;">
        </div>
        <h4>How many payments per page:</h4>
        <form method="post" action="">
            <select name="rowstoshow">
                <option selected disable hidden>#entries to show</option>
                <option value="20">last 20</option>
                <option value="40">last 40</option>
                <option value="60">last 60</option>
            </select>
            <input type="submit" name="submit">
        </form>
        <div class="title"><h2>Payments:</h2></div>
        <div class="table">
            <?php
//check if rows to be shown selector is not set and in that case show first 20 entries
//otherwise get it from the HTML form
                if (!(isset($_POST["rowstoshow"]))) {
                    $customer = 20;
                } else {
                $customer = $_POST["rowstoshow"];
                }
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
                    $stmt = $conn->query("SELECT * FROM payments");
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    }
//catch exception and display error message  
                catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    }

//start building table
                echo "<table>";
                echo "<tr><th>Check#</th><th>Date</th><th>Amount</th><th>Customer#</th></tr>";
//initialise counter, set while loop to generate table rows            
                $i = 1;
                while ($row = $stmt->fetch()) {
                    if ($i <= $customer) {
                    echo "<tr>";
                    echo "<td>".$row['checkNumber']."</td>";
                    echo "<td>".$row['paymentDate']."</td>";
                    echo "<td>".$row['amount']."</td>";
//generate anchor element pointing to new PHP generated page about single customer
//include customer id in URL to be used with GET method in paymentinfo.php
                    echo "<td><a href='paymentinfo.php?id=".$row['customerNumber']."'>".$row['customerNumber']."</a></td>";
                    echo "</tr>";
                    }
//increase counter
                $i++;
                }
                echo "</table>";
                $conn = null;
            ?>
        </div>
    </main>
<!--include PHP footer-->
    <footer><div class="footer"><?php include "footer.php" ?></div></footer>
</body>