<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>payments extra info</title>
<link rel="stylesheet" href="classicmodels.css" type= "text/css"/>
</head>
<body>
<!--include PHP header-->
    <header><div class="header"><?php include "header.php" ?></div></header>
    <main>
<!--title and logo-->
        <div class="container">
            <img src="images/car2.jpg" style="width:100%; height:100px;">
        </div>
            <?php
//declare connection variables
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "classicmodels";
//use GET method to obtain customer id from URL - needed to identify specific customer
                $customer_id = $_GET['id'];
        
//try to connect to database using PDO        
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//                  echo "Connected successfully";
//set first query
                    $stmt = $conn->query("SELECT P.amount, P.checkNumber, P.paymentDate FROM customers as C, payments as P WHERE C.customerNumber = P.customerNumber and P.customerNumber = '$customer_id'");
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
//set second query
                    $stmt2 = $conn->query("SELECT C.customerName, C.phone, C.salesRepEmployeeNumber, C.creditLimit FROM customers as C, payments as P WHERE C.customerNumber = P.customerNumber and P.customerNumber = '$customer_id'");
                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                    }
//catch exception and display error message  
                catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    }
        
//results for the second query - customer information
//no while loop needed - table with just one single row displaying customer data
                $row = $stmt2->fetch();
                echo "<div class='title'><h2>Customer ".$customer_id." details:</h2></div>";
                echo "<div class='table'>";
                echo "<table class='infotable' style='width:90%;margin-bottom:50px;'>";
                echo "<tr><th>Name</th><th>Phone number</th><th>Sales Representative number</th><th>Credit limit</th></tr>";
                echo "<tr><td style='font-weight:900;'>".$row['customerName']."</td><td>".$row['phone']."</td><td>".$row['salesRepEmployeeNumber']."</td><td>".$row['creditLimit']."</td></tr>";
                echo "</table>";        
                echo "<div class='title'><h3>Payment history:</h3>";
                echo "<table class='paymentstable' style='width:60%;'>";
                echo "<tr><th>Check Number</th><th>Payment Date</th><th>Amount Paid</th></tr>";
        
//results for the first query - payment history
//set a while loop to build table rows
//calculate running totale for total amount
                $sum = 0;
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>".$row['checkNumber']."</td>";
                    echo "<td>".$row['paymentDate']."</td>";
                    echo "<td>".$row['amount']."</td>";
                    echo "</tr>";
                    $sum += $row['amount'];  
                } 
//display total row with special formatting
                echo "<tr id='totalrow' style='color:white; background-color: rgb(0, 0, 0);font-weight: bolder;'><td colspan='2' id='totaltxt' style='text-transform:uppercase; text-align:right;'>Total amount: </td><td id='totaltxt' style='text-transform:uppercase;'>".$sum."</td></tr>";
                echo "</table>";
                $conn = null;
            ?>
    </main>
<!--no footer here, as it is a detail sub-page to display-->
</body>