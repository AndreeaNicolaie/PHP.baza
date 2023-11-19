
<?php
include("conectare.php");
$error = '';

if (isset($_POST['submit'])) {
    $numePartener = htmlentities($_POST['numePartener'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $contactNume = htmlentities($_POST['contactNume'], ENT_QUOTES);
    $contactEmail = htmlentities($_POST['contactEmail'], ENT_QUOTES);
    $contactTelefon = htmlentities($_POST['contactTelefon'], ENT_QUOTES);
    $idEveniment = intval($_POST['idEveniment']);
    $idPachet = intval($_POST['idPachet']);

    if ($numePartener == '' || $descriere == '' || $contactNume == '' || $contactEmail == '' || $contactTelefon == '' || $idEveniment == 0 || $idPachet == 0) {
        $error = 'ERROR: Campuri goale!';
    } else {
        if ($stmt = $mysqli->prepare("INSERT INTO partener(Nume_Partener, Descriere, Contact_Nume, Contact_Email, Contact_Telefon, ID_Eveniment, ID_Pachet) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("ssssssi", $numePartener, $descriere, $contactNume, $contactEmail, $contactTelefon, $idEveniment, $idPachet);
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
    <title><?php echo "Inserare inregistrare partener"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1><?php echo "Inserare inregistrare partener"; ?></h1>
    <?php
    if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    }
    ?>
    <form action="" method="post">
        <div>
            <strong> Nume Partener: </strong> <input type="text" name="numePartener" value="" /> <br />
            <strong> Descriere: </strong> <input type="text" name="descriere" value="" /> <br />
            <strong> Contact Nume: </strong> <input type="text" name="contactNume" value="" /> <br />
            <strong> Contact Email: </strong> <input type="text" name="contactEmail" value="" /> <br />
            <strong> Contact Telefon: </strong> <input type="text" name="contactTelefon" value="" /> <br />
            <strong> ID Eveniment: </strong> <input type="text" name="idEveniment" value="" /> <br />
            <strong> ID Pachet: </strong> <input type="text" name="idPachet" value="" /> <br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="vizualizare_partener.php">Index Partener</a>
        </div>
    </form>
</body>

</html>

