<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* =======================
   DATABASE CONNECTION
======================= */

$con = mysqli_connect("localhost", "root", "", "pms");

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

/* =======================
   CREATE TABLE
======================= */

$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chocolate_mousse INT DEFAULT 0,
    biscuit_roll INT DEFAULT 0,
    macarons INT DEFAULT 0,
    truffies INT DEFAULT 0,
    nutella INT DEFAULT 0,
    churros INT DEFAULT 0,
    total_bill DECIMAL(10,2) DEFAULT 0
)";

mysqli_query($con, $sql);

/* =======================
   PRICES
======================= */

$prices = [
    "chocolate_mousse" => 2000,
    "biscuit_roll" => 1500,
    "macarons" => 1000,
    "truffies" => 4500,
    "nutella" => 5000,
    "churros" => 5000
];

/* =======================
   INPUT VALUES
======================= */

$chocolate_mousse = $_POST['chocolate_mousse'] ?? 0;
$biscuit_roll     = $_POST['biscuit_roll'] ?? 0;
$macarons         = $_POST['macarons'] ?? 0;
$truffies         = $_POST['truffies'] ?? 0;
$nutella          = $_POST['nutella'] ?? 0;
$churros          = $_POST['churros'] ?? 0;

/* =======================
   TOTAL CALCULATION
======================= */

$total_bill =
    $chocolate_mousse * $prices['chocolate_mousse'] +
    $biscuit_roll * $prices['biscuit_roll'] +
    $macarons * $prices['macarons'] +
    $truffies * $prices['truffies'] +
    $nutella * $prices['nutella'] +
    $churros * $prices['churros'];

/* =======================
   INSERT DATA
======================= */

$insert = "INSERT INTO orders (
    chocolate_mousse,
    biscuit_roll,
    macarons,
    truffies,
    nutella,
    churros,
    total_bill
) VALUES (
    '$chocolate_mousse',
    '$biscuit_roll',
    '$macarons',
    '$truffies',
    '$nutella',
    '$churros',
    '$total_bill'
)";

mysqli_query($con, $insert);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Result</title>

<style>
body{
    font-family: Arial;
    background: #f2f2f2;
    padding: 30px;
}

.box{
    background: white;
    padding: 30px;
    border-radius: 15px;
    width: 500px;
    margin: auto;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}

h1{
    text-align: center;
}
</style>
</head>

<body>

<div class="box">

<h1>Your Order</h1>

<?php
if($chocolate_mousse > 0) echo "Chocolate Mousse: $chocolate_mousse <br>";
if($biscuit_roll > 0) echo "Biscuit Roll: $biscuit_roll <br>";
if($macarons > 0) echo "Macarons: $macarons <br>";
if($truffies > 0) echo "Truffies: $truffies <br>";
if($nutella > 0) echo "Nutella: $nutella <br>";
if($churros > 0) echo "Churros: $churros <br>";

echo "<hr>";
echo "<h2>Total Bill = $total_bill IQD</h2>";

mysqli_close($con);
?>

</div>

</body>
</html>