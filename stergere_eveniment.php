<?php
include("conectare.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    if ($stmt = $mysqli->prepare("DELETE FROM eveniment WHERE ID_Eveniment=? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo "<div>Inregistrarea a fost stearsa</div>";
    } else {
        echo "error: nu se poate executa delete.";
    }
    echo "<p><a href=\"vizualizare_eveniment.php\">Index</a></p>";
}
$mysqli->close();
?>

