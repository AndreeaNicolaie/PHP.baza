<html>

<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>

<body>
    <h1>Inregistrarile din tabela partener</h1>
    <p><b>Toate inregistrarile din partener</b></p>
    <?php
    include("conectare.php");

    // Interogarea SQL
    $sql = "SELECT * FROM partener ORDER BY ID_Partener";
    $result = $mysqli->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID Partener</th><th>Nume Partener</th><th>Descriere</th><th>Contact Nume</th><th>Contact Email</th><th>Contact Telefon</th><th>ID Eveniment</th><th>ID Pachet</th><th></th><th></th></tr>";

            while ($row = $result->fetch_object()) {
                echo "<tr>";
                echo "<td>" . $row->ID_Partener . "</td>";
                echo "<td>" . $row->Nume_Partener . "</td>";
                echo "<td>" . $row->Descriere . "</td>";
                echo "<td>" . $row->Contact_Nume . "</td>";
                echo "<td>" . $row->Contact_Email . "</td>";
                echo "<td>" . $row->Contact_Telefon . "</td>";
                echo "<td>" . $row->ID_Eveniment . "</td>";
                echo "<td>" . $row->ID_Pachet . "</td>";
                echo "<td><a href='modificare.php?id=" . $row->ID_Partener . "'>Modificare</a></td>";
                echo "<td><a href='stergere.php?id=" . $row->ID_Partener . "'>Stergere</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nu sunt inregistrari in tabela partener!";
        }
    } else {
        echo "Error: " . $mysqli->error;
    }

    $mysqli->close();
    ?>
    <a href="inserare_partener.php">Adaugarea unei noi inregistrari</a>
</body>

</html>
