<?php
include("conectare.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    if ($stmt = $mysqli->prepare("DELETE FROM agenda WHERE ID_Agenda = ? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo "<div>Inregistrarea a fost stearsa</div>";
    } else {
        echo "Error: nu se poate executa delete.";
    }
}

$mysqli->close();
?>
<html>

<head>
    <title>Stergere inregistrare</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <p><a href="vizualizare_agenda.php">Index</a></p>
</body>

</html>

