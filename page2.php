<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
      $con = mysqli_connect("localhost", "root", ""); 

    if (!$con) {  
        die('Could not connect: ' . mysqli_connect_error()); 
    } 
      if (mysqli_query($con, "CREATE DATABASE IF NOT EXISTS pms")) { 
             mysqli_select_db($con, "pms");
    } 
        $sql = "CREATE TABLE IF NOT EXISTS menu (
        item_id INT AUTO_INCREMENT PRIMARY KEY,
        item_name VARCHAR(100) NOT NULL, 
        price DECIMAL(10, 2) NOT NULL
    )";

    if (mysqli_query($con, $sql))
         {
        echo" it created successfully";
        }
           $sql2 = "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        table_number INT NOT NULL,       
        item_id INT,                    
        quantity INT NOT NULL,           
        total_price DECIMAL(10, 2),       
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
        FOREIGN KEY (item_id) REFERENCES menu(item_id)      
    )";


    mysqli_query($con, $sql2);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cake = isset($_POST['chocolate_cake']) ? $_POST['chocolate_cake'] : 0;
    $biscuit = isset($_POST['qbiscuit_roll']) ? $_POST['qbiscuit_roll'] : 0;
    $macarons = isset($_POST['macarons']) ? $_POST['macarons'] : 0;
    $truffies = isset($_POST['truffies']) ? $_POST['truffies'] : 0;
    $nutella = isset($_POST['nutella']) ? $_POST['nutella'] : 0;
    $churros = isset($_POST['churros']) ? $_POST['churros'] : 0;

    
    echo "<h2>Your Orders are:</h2>";

if ($cake > 0) {
    echo "Chocolate Cake: " . $cake . "<br>";
}

if ($biscuit > 0) {
    echo "Biscuit Roll: " . $biscuit. "<br>";
}

if ($macarons > 0) {
    echo "Macarons: " . $macarons. "<br>";
}
if ($truffies > 0) {    
    echo "Truffies: " . $truffies . "<br>";
}
if ($nutella > 0) {
    echo "Nutella: " . $nutella. "<br>";
}
if ($churros > 0) { 
    echo "Churros: " . $churros. "<br>";
}



    $prices = [
        "chocolate_cake" => 2000,
        "qbiscuit_roll"  => 1500,
        "macarons"       => 1000,
        "truffies"       => 4500,
        "nutella"        => 5000,
        "churros"        => 3000
    ];

    $total_bill = 0;
    echo "<h2>Total Bill:</h2>";


     $cake_qty = isset($_POST['chocolate_cake']) ? $_POST['chocolate_cake'] : 0;
    if ($cake_qty > 0) {
        $cost = $cake_qty * $prices["chocolate_cake"];
        echo "Chocolate Cake: $cake_qty x " . $prices["chocolate_cake"] . " = $cost <br>";
        $total_bill += $cost;
    }


      $biscuit_qty = isset($_POST['qbiscuit_roll']) ? $_POST['qbiscuit_roll'] : 0;
    if ($biscuit_qty > 0) {
        $cost = $biscuit_qty * $prices["qbiscuit_roll"];
        echo "Biscuit Roll: $biscuit_qty x " . $prices["qbiscuit_roll"] . " = $cost <br>";
        $total_bill += $cost;
    }



     $macarons_qty = isset($_POST['macarons']) ? $_POST['macarons'] : 0;
    if ($macarons_qty > 0) {
        $cost = $macarons_qty * $prices["macarons"];
        echo "Macarons: $macarons_qty x " . $prices["macarons"] . " = $cost <br>";
        $total_bill += $cost;
    }
    $truffies_qty = isset($_POST['truffies']) ? $_POST['truffies'] : 0;
    if ($truffies_qty > 0) {    
        $cost = $truffies_qty * $prices["truffies"];
        echo "Truffies: $truffies_qty x " . $prices["truffies"] . " = $cost <br>";
        $total_bill += $cost;
    }
    $nutella_qty = isset($_POST['nutella']) ? $_POST['nutella'] : 0;
    if ($nutella_qty > 0) {           
        $cost = $nutella_qty * $prices["nutella"];
        echo "Nutella: $nutella_qty x " . $prices["nutella"] . " = $cost <br>";
        $total_bill += $cost;
    }
    $churros_qty = isset($_POST['churros']) ? $_POST['churros'] : 0;
    if ($churros_qty > 0) {
        $cost = $churros_qty * $prices["churros"];
        echo "Churros: $churros_qty x " . $prices["churros"] . " = $cost <br>";
        $total_bill += $cost;
    }


     echo "---------------------------<br>";
   echo "<strong>Total Bill: $total_bill</strong><br>";
}

 mysqli_close($con);
?>
</body>
</html>