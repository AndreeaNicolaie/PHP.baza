<?php
include("conectare.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    if ($stmt = $mysqli->prepare("DELETE FROM partener WHERE ID_Partener=? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        echo "<div>Inregistrarea a fost stearsa</div>";
        echo "<p><a href=\"vizualizare_partener.php\">Index Partener</a></p>";
    } else {
        echo "Error: Nu se poate executa delete.";
    }
    echo "<p><a href=\"vizualizare_partener.php\">Index</a></p>";
}
$mysqli->close();
?>

