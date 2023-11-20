<?php
require_once "DBController.php";

class ShoppingCart extends DBController {
    // Fetch all tickets with event details
    function getAllTickets() {
        $query = "SELECT bilet.ID_Bilet, eveniment.Nume_Eveniment, bilet.Tip_Bilet, bilet.Pret FROM bilet JOIN eveniment ON bilet.ID_Eveniment = eveniment.ID_Eveniment";
        return $this->getDBResult($query);
    }
    function getTicketById($ticket_id) {
        $query = "SELECT * FROM bilet WHERE ID_Bilet = ?";
        $params = array(
            array("param_type" => "i", "param_value" => $ticket_id)
        );
        return $this->getDBResult($query, $params);
    }
    


    // Fetch cart items for a member
    function getMemberCartItems($member_id) {
        $query = "SELECT bilet.*, tbl_cart.id as cart_id, tbl_cart.quantity FROM bilet, tbl_cart WHERE bilet.ID_Bilet = tbl_cart.ticket_id AND tbl_cart.member_id=?";
        $params = array(
            array("param_type" => "i", "param_value" => $member_id)
        );
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult ?? []; // Return an empty array if null
    }
    
    

    // Add a ticket to the cart
    function addToCart($ticket_id, $quantity, $member_id) {
        $query = "INSERT INTO tbl_cart (ticket_id, quantity, member_id) VALUES (?, ?, ?)";
        $params = array(
            array("param_type" => "i", "param_value" => $ticket_id),
            array("param_type" => "i", "param_value" => $quantity),
            array("param_type" => "i", "param_value" => $member_id)
        );
        $this->updateDB($query, $params);
    }

    // Update cart quantity
    function updateCartQuantity($quantity, $cart_id) {
        $query = "UPDATE tbl_cart SET quantity = ? WHERE id = ?";
        $params = array(
            array("param_type" => "i", "param_value" => $quantity),
            array("param_type" => "i", "param_value" => $cart_id)
        );
        $this->updateDB($query, $params);
    }

    // Delete a cart item
    function deleteCartItem($cart_id) {
        $query = "DELETE FROM tbl_cart WHERE id = ?";
        $params = array(array("param_type" => "i", "param_value" => $cart_id));
        $this->updateDB($query, $params);
    }

    // Empty the cart for a member
    function emptyCart($member_id) {
        $query = "DELETE FROM tbl_cart WHERE member_id = ?";
        $params = array(array("param_type" => "i", "param_value" => $member_id));
        $this->updateDB($query, $params);
    }
}
?>
