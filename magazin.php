<?php
require_once "ShoppingCart.php";
?>
<html>
    <head>
        <title>Creare cos cumparaturi</title>
        <link href="style.css" type="text/css" rel="stylesheet" /> 
    </head>
    <body>
        <div id="product-grid">
            <div class="txt-heading">
                <div class="txt-heading-label">Tickets</div>
            </div>
            <?php
            $shoppingCart = new ShoppingCart();
            $ticket_array = $shoppingCart->getAllTickets(); // Use getAllTickets method
            if (!empty($ticket_array)) {
                foreach ($ticket_array as $key => $value) {
                    ?>
                    <div class="product-item">
                        <form method="post" action="cos.php?action=add&ticket_id=<?php echo $ticket_array[$key]["ID_Bilet"]; ?>">
                            <div>
                                <strong><?php echo $ticket_array[$key]["Nume_Eveniment"] . " - " . $ticket_array[$key]["Tip_Bilet"]; ?></strong>
                            </div>
                            <div class="product-price"><?php echo "$" . $ticket_array[$key]["Pret"]; ?></div>
                            <div>
                                <input type="text" name="quantity" value="1" size="2" />
                                <input type="submit" value="Add to cart" class="btnAddAction" />
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>
