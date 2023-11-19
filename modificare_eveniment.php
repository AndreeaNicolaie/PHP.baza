<?php
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $numeEveniment = htmlentities($_POST['nume_eveniment'], ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
            $locatie = htmlentities($_POST['locatie'], ENT_QUOTES);
            $numarParticipantMaxim = htmlentities($_POST['numar_participant_maxim'], ENT_QUOTES);

            if ($numeEveniment == '' || $descriere == '' || $locatie == '' || $numarParticipantMaxim == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE eveniment SET Nume_Eveniment=?, Descriere=?, Locatie=?, Numar_Participant_Maxim=? WHERE ID_Eveniment='" . $id . "'")) {
                    $stmt->bind_param("sssi", $numeEveniment, $descriere, $locatie, $numarParticipantMaxim);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        } else {
            echo "id incorect!";
        }
    }
}
?>

<html>

<head>
    <title> <?php if ($_GET['id'] != '') {
                echo "Modificare inregistrare";
            } ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
<h1><?php if (isset($_GET['id']) && $_GET['id'] != '') {
            echo "Modificare Inregistrare";
        } ?></h1>

    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>

    <form action="" method="post">
        <div>
        <?php if (isset($_GET['id']) && $_GET['id'] != '') { ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <p>ID: <?php echo $_GET['id'];
                        if ($result = $mysqli->query("SELECT * FROM eveniment WHERE ID_Eveniment='" . $_GET['id'] . "'")) {
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_object(); ?></p>
                                <strong>Nume Eveniment: </strong> <input type="text" name="nume_eveniment" value="<?php echo $row->Nume_Eveniment; ?>" /><br />
                                <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->Descriere; ?>" /><br />
                                <strong>Locatie: </strong> <input type="text" name="locatie" value="<?php echo $row->Locatie; ?>" /><br />
                                <strong>Numar Participant Maxim: </strong> <input type="text" name="numar_participant_maxim" value="<?php echo $row->Numar_Participant_Maxim; ?>" /><br />
            <?php }
                        }
                    } ?>
            <br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="vizualizare_eveniment.php">Index</a>
        </div>
    </form>
</body>

</html>

