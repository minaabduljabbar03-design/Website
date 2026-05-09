<?php

$con = mysqli_connect("localhost","root","");

if(!$con)
{
    die("Connection Failed: " . mysqli_connect_error());
}

mysqli_query($con,"CREATE DATABASE IF NOT EXISTS pms");

mysqli_select_db($con,"pms");


$sql = "CREATE TABLE IF NOT EXISTS orders (

    id INT AUTO_INCREMENT PRIMARY KEY,

    chocolate_mousse INT,
    biscuit_roll INT,
    macarons INT,
    truffies INT,
    nutella INT,
    churros INT,

    total_bill DECIMAL(10,2)
)";

mysqli_query($con,$sql);


$prices = [

    "chocolate_mousse" => 2000,
    "biscuit_roll" => 1500,
    "macarons" => 1000,
    "truffies" => 4500,
    "nutella" => 5000,
    "churros" => 5000
];


$chocolate_mousse =
isset($_POST['chocolate_mousse']) ?
$_POST['chocolate_mousse'] : 0;

$biscuit_roll =
isset($_POST['biscuit_roll']) ?
$_POST['biscuit_roll'] : 0;

$macarons =
isset($_POST['macarons']) ?
$_POST['macarons'] : 0;

$truffies =
isset($_POST['truffies']) ?
$_POST['truffies'] : 0;

$nutella =
isset($_POST['nutella']) ?
$_POST['nutella'] : 0;

$churros =
isset($_POST['churros']) ?
$_POST['churros'] : 0;


$total_bill = 0;

$total_bill += $chocolate_mousse * $prices['chocolate_mousse'];

$total_bill += $biscuit_roll * $prices['biscuit_roll'];

$total_bill += $macarons * $prices['macarons'];

$total_bill += $truffies * $prices['truffies'];

$total_bill += $nutella * $prices['nutella'];

$total_bill += $churros * $prices['churros'];


$insert = "INSERT INTO orders
(
    chocolate_mousse,
    biscuit_roll,
    macarons,
    truffies,
    nutella,
    churros,
    total_bill
)

VALUES
(
    '$chocolate_mousse',
    '$biscuit_roll',
    '$macarons',
    '$truffies',
    '$nutella',
    '$churros',
    '$total_bill'
)";

mysqli_query($con,$insert);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Result</title>

    <style>

        body{
            font-family:Arial;
            background:#f2f2f2;
            padding:30px;
        }

        .box{
            background:white;
            padding:30px;
            border-radius:15px;
            width:500px;
            margin:auto;
            box-shadow:0 0 10px rgba(0,0,0,0.2);
        }

        h1{
            text-align:center;
        }

    </style>

</head>

<body>

<div class="box">

<h1>Your Order</h1>

<?php

if($chocolate_mousse > 0)
{
    echo "Chocolate Mousse: $chocolate_mousse <br>";
}

if($biscuit_roll > 0)
{
    echo "Biscuit Roll: $biscuit_roll <br>";
}

if($macarons > 0)
{
    echo "Macarons: $macarons <br>";
}

if($truffies > 0)
{
    echo "Truffies: $truffies <br>";
}

if($nutella > 0)
{
    echo "Nutella Puff Pastry: $nutella <br>";
}

if($churros > 0)
{
    echo "Churros: $churros <br>";
}

echo "<hr>";

echo "<h2>Total Bill = $total_bill IQD</h2>";

mysqli_close($con);

?>

</div>

</body>
</html>
