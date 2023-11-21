<?php
session_start();
require_once "ShoppingCart.php";
require_once "DBController.php"; 
$db_handle = new DBController(); 
$shoppingCart = new ShoppingCart();
$User_ID = $_SESSION['loggedin'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    $cartItems = $shoppingCart->getMemberCartItems($User_ID);
    if (!empty($cartItems)) {
        foreach ($cartItems as $item) {
            $query = "INSERT INTO tbl_cart (User_ID, Ticket_ID, Quantity) VALUES (?, ?, ?)";
            $stmt = $db_handle->conn->prepare($query);
            if ($stmt === false) {
                die("Eroare la pregătirea query-ului: " . $db_handle->conn->error);
            }
            
            $stmt->bind_param("iii", $User_ID, $item["ID_Bilet"], $item["Quantity"]);
            
            $stmt->execute();
            
            if($stmt->error) {
                die("Eroare la executarea query-ului: " . $stmt->error);
            }

            $stmt->close();
        }    
        $shoppingCart->emptyCart($User_ID);
        echo "Comanda a fost trimisă!";
        echo "<a href=\"style.html\">Home</a>";
    }
}

?>
