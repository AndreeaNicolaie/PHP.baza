<?php
include("conectare.php");
$error = '';
if (isset($_POST['submit'])) {
    $id_eveniment = htmlentities($_POST['id_eveniment'], ENT_QUOTES);
    $nume_sesiune = htmlentities($_POST['nume_sesiune'], ENT_QUOTES);
    $ora_inceput = htmlentities($_POST['ora_inceput'], ENT_QUOTES);
    $ora_sfarsit = htmlentities($_POST['ora_sfarsit'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $data_eveniment = htmlentities($_POST['data_eveniment'], ENT_QUOTES);

    if ($id_eveniment == '' || $nume_sesiune == '' || $ora_inceput == '' || $ora_sfarsit == '' || $descriere == '' || $data_eveniment == '') {
        $error = 'ERROR: Campuri goale!';
    } else {
        if ($stmt = $mysqli->prepare("INSERT INTO agenda(ID_Eveniment, Nume_Sesiune, Ora_Inceput, Ora_Sfarsit, Descriere, Data_Eveniment) VALUES (?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("isssss", $id_eveniment, $nume_sesiune, $ora_inceput, $ora_sfarsit, $descriere, $data_eveniment);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
$mysqli->close();
?>

<html>

<head>
    <title><?php echo "Inserare inregistrare"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1><?php echo "Inserare inregistrare"; ?></h1>
    <?php
    if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    }
    ?>
    <form action="" method="post">
        <div>
            <strong> ID Eveniment: </strong> <input type="text" name="id_eveniment" value="" /> <br />
            <strong> Nume Sesiune: </strong> <input type="text" name="nume_sesiune" value="" /> <br />
            <strong> Ora Inceput: </strong> <input type="text" name="ora_inceput" value="" /> <br />
            <strong> Ora Sfarsit: </strong> <input type="text" name="ora_sfarsit" value="" /> <br />
            <strong> Descriere: </strong> <input type="text" name="descriere" value="" /> <br />
            <strong> Data Eveniment: </strong> <input type="text" name="data_eveniment" value="" /> <br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="vizualizare_agenda.php">Index</a>
        </div>
    </form>
</body>

</html>
