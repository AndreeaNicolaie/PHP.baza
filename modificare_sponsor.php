<?php
// Conectare la baza de date
include("conectare.php");
$error = '';

// Extrage lista de evenimente
$resultEveniment = $mysqli->query("SELECT ID_Eveniment, Nume_Eveniment FROM eveniment");
$evenimente = $resultEveniment->fetch_all(MYSQLI_ASSOC);

if (isset($_GET['ID_Sponsor']) && is_numeric($_GET['ID_Sponsor'])) {
    $ID_Sponsor = $_GET['ID_Sponsor'];

    // Extrage informațiile sponsorului curent
    if ($result = $mysqli->query("SELECT * FROM sponsor WHERE ID_Sponsor = $ID_Sponsor")) {
        $row = $result->fetch_object();
    }

    // Procesarea formularului la trimitere
    if (isset($_POST['submit'])) {
        $Nume_Sponsor = htmlentities($_POST['Nume_Sponsor'], ENT_QUOTES);
        // Restul codului de procesare rămâne neschimbat...
    }
    // Restul codului de validare și actualizare rămâne neschimbat...
}
$mysqli->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Modificare Inregistrare Sponsor</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>
<body>
    <h1>Modificare Inregistrare Sponsor</h1>

    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>

    <form action="" method="post">
        <div>
            <?php if ($ID_Sponsor) { ?>
                <input type="hidden" name="ID_Sponsor" value="<?php echo $ID_Sponsor; ?>" />
                <p>ID: <?php echo $ID_Sponsor; ?></p>
                <strong>Nume Sponsor:</strong> <input type="text" name="Nume_Sponsor" value="<?php echo $row->Nume_Sponsor; ?>" /><br />
                <strong>Descriere:</strong> <input type="text" name="Descriere" value="<?php echo $row->Descriere; ?>" /><br />
                <strong>Contact Nume:</strong> <input type="text" name="Contact_Nume" value="<?php echo $row->Contact_Nume; ?>" /><br />
                <strong>Contact Email:</strong> <input type="email" name="Contact_Email" value="<?php echo $row->Contact_Email; ?>" /><br />
                <strong>Contact Telefon:</strong> <input type="text" name="Contact_Telefon" value="<?php echo $row->Contact_Telefon; ?>" /><br />
                <strong>Eveniment:</strong>
                <select name="ID_Eveniment">
                    <?php foreach ($evenimente as $eveniment) {
                        $selected = ($eveniment['ID_Eveniment'] == $row->ID_Eveniment) ? 'selected' : '';
                        echo "<option value='" . $eveniment['ID_Eveniment'] . "' $selected>" . $eveniment['Nume_Eveniment'] . "</option>";
                    } ?>
                </select><br />
                <br />
                <input type="submit" name="submit" value="Submit" />
                <a href="vizualizare_sponsor.php">Index</a>
            <?php } ?>
        </div>
    </form>
</body>
</html>
