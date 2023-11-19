<html>

<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>

<body>
    <h1>Inregistrarile din agenda</h1>
    <p><b>Toate inregistrarile din agenda</b></p>
    <?php
    include("conectare.php");

    // Interogarea SQL
    $sql = "SELECT * FROM agenda ORDER BY ID_Agenda";
    $result = $mysqli->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID Agenda</th><th>ID Eveniment</th><th>Nume Sesiune</th><th>Ora Inceput</th><th>Ora Sfarsit</th><th>Descriere</th><th>Data Eveniment</th><th></th><th></th></tr>";

            while ($row = $result->fetch_object()) {
                echo "<tr>";
                echo "<td>" . $row->ID_Agenda . "</td>";
                echo "<td>" . $row->ID_Eveniment . "</td>";
                echo "<td>" . $row->Nume_Sesiune . "</td>";
                echo "<td>" . $row->Ora_Inceput . "</td>";
                echo "<td>" . $row->Ora_Sfarsit . "</td>";
                echo "<td>" . $row->Descriere . "</td>";
                echo "<td>" . $row->Data_Eveniment . "</td>";
                echo "<td><a href='modificare.php?id=" . $row->ID_Agenda . "'>Modificare</a></td>";
                echo "<td><a href='stergere.php?id=" . $row->ID_Agenda . "'>Stergere</a></td>";
                echo "</tr>";
            }
            echo "</table>";

        } else {
            echo "Nu sunt inregistrari in tabela!";
        }

    } else {
        echo "Error: " . $mysqli->error;
    }
    $mysqli->close();
    ?>
    <a href="inserare_agenda.php">Adaugarea unei noi inregistrari</a>
</body>

</html>
