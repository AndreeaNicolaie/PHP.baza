<?php
require_once "ShoppingCart.php";
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

$member_id = $_SESSION['loggedin'];
$shoppingCart = new ShoppingCart();

if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $ticketResult = $shoppingCart->getTicketById($_GET["ticket_id"]);
                if (!empty($ticketResult)) {
                    $cartItems = $shoppingCart->getMemberCartItems($member_id);

                    $cartItemFound = false;
                    foreach ($cartItems as $cartItem) {
                        if ($cartItem["ID_Bilet"] == $ticketResult[0]["ID_Bilet"]) {
                            $newQuantity = $cartItem["quantity"] + $_POST["quantity"];
                            $shoppingCart->updateCartQuantity($newQuantity, $cartItem["cart_id"]);
                            $cartItemFound = true;
                            break;
                        }
                    }

                    if (!$cartItemFound) {
                        // Add to cart table
                        $shoppingCart->addToCart($ticketResult[0]["ID_Bilet"], $_POST["quantity"], $member_id);
                    }
                }
            }
            break;
        case "remove":
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            $shoppingCart->emptyCart($member_id);
            break;
    }
}
?>

<html>
<head>
<title>Creare cos permanent in PHP</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="shopping-cart">
        <div class="txt-heading">
            <div class="txt-heading-label">Cos Cumparaturi</div> 
            <a id="btnEmpty" href="cos.php?action=empty"><img src="empty-cart.png" alt="empty-cart" title="Empty Cart" /></a>
        </div>
        <?php
        $cartItems = $shoppingCart->getMemberCartItems($member_id); 
        if(is_array($cartItems)) {
            $item_total = 0;
            ?>
            <table cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th style="text-align: left;"><strong>Event Name</strong></th>
                        <th style="text-align: left;"><strong>Ticket Type</strong></th>
                        <th style="text-align: right;"><strong>Quantity</strong></th>
                        <th style="text-align: right;"><strong>Price</strong></th>
                        <th style="text-align: center;"><strong>Action</strong></th>
                    </tr>
                    <?php
                    foreach ($cartItems as $item) {
                        ?>
                        <tr>
                            <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["Nume_Eveniment"]; ?></strong></td>
                            <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["Tip_Bilet"]; ?></td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo "$".$item["Pret"]; ?></td>
                            <td style="text-align: center; border-bottom: #F0F0F0 1px solid;"><a href="cos.php?action=remove&id=<?php echo $item["cart_id"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="icon-delete" title="Remove Item" /></a></td>
                        </tr>
                        <?php
                        $item_total += ($item["Pret"] * $item["quantity"]);
                    }
                    ?>
                        <tr>
                            <td colspan="3" align=right><strong>Total:</strong></td>
                            <td align=right><?php echo "$".$item_total; ?></td>
                            <td></td>
                        </tr>
                </tbody>
            </table>
            <?php
        }
        ?>
    </div>
    <div><a href="magazin.php">Alegeti alt produs</a></div>
    <div><a href="logout.php">Abandonati sesiunea de cumparare</a></div>

</body>
</html>
