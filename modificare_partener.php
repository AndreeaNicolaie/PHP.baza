<?php
// connectare bazadedate 
include("Conectare.php");

// Modificare datelor 
// se preia id din pagina vizualizare 
$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        // verificam daca id-ul din URL este unul valid  
        if (is_numeric($_POST['id'])) {
            // preluam variabilele din URL/form  
            $id = $_POST['id'];
            $numePartener = htmlentities($_POST['numePartener'], ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
            $contactNume = htmlentities($_POST['contactNume'], ENT_QUOTES);
            $contactEmail = htmlentities($_POST['contactEmail'], ENT_QUOTES);
            $contactTelefon = htmlentities($_POST['contactTelefon'], ENT_QUOTES);
            $idEveniment = intval($_POST['idEveniment']);
            $idPachet = intval($_POST['idPachet']);

            // verificam daca numele, prenumele, an si grupa nu sunt goale  
            if ($numePartener == '' || $descriere == '' || $contactNume == '' || $contactEmail == '' || $contactTelefon == '' || $idEveniment == 0 || $idPachet == 0) {
                // daca sunt goale afisam mesaj de eroare    
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                // daca nu sunt erori se face update Nume_Partener, Descriere, Contact_Nume, Contact_Email, Contact_Telefon, ID_Eveniment, ID_Pachet  
                if ($stmt = $mysqli->prepare("UPDATE partener SET Nume_Partener=?, Descriere=?, Contact_Nume=?, Contact_Email=?, Contact_Telefon=?, ID_Eveniment=?, ID_Pachet=? WHERE ID_Partener='" . $id . "'")) {
                    $stmt->bind_param("ssssssi", $numePartener, $descriere, $contactNume, $contactEmail, $contactTelefon, $idEveniment, $idPachet);
                    $stmt->execute();
                    $stmt->close();
                } // mesaj de eroare in caz ca nu se poate face update    
                else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        }
        // daca variabila 'id' nu este valida, afisam mesaj de eroare 
        else {
            echo "id incorect!";
        }
    }
}
?>

<html>

<head>
    <title> <?php if ($_GET['id'] != '') {
                echo "Modificare inregistrare partener";
            } ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>

<body>
    <h1><?php if ($_GET['id'] != '') {
            echo "Modificare Inregistrare partener";
        } ?></h1>

    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>

    <form action="" method="post">
        <div>
            <?php if ($_GET['id'] != '') { ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <p>ID_Partener: <?php echo $_GET['id'];
                                if ($result = $mysqli->query("SELECT * FROM partener WHERE ID_Partener='" . $_GET['id'] . "'")) {
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_object(); ?></p>
                                        <strong>Nume Partener: </strong> <input type="text" name="numePartener" value="<?php echo $row->Nume_Partener; ?>" /><br />
                                        <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->Descriere; ?>" /><br />
                                        <strong>Contact Nume: </strong> <input type="text" name="contactNume" value="<?php echo $row->Contact_Nume; ?>" /><br />
                                        <strong>Contact Email: </strong> <input type="text" name="contactEmail" value="<?php echo $row->Contact_Email; ?>" /><br />
                                        <strong>Contact Telefon: </strong> <input type="text" name="contactTelefon" value="<?php echo $row->Contact_Telefon; ?>" /><br />
                                        <strong>ID Eveniment: </strong> <input type="text" name="idEveniment" value="<?php echo $row->ID_Eveniment; ?>" /><br />
                                        <strong>ID Pachet: </strong> <input type="text" name="idPachet" value="<?php echo $row->ID_Pachet; ?>" /><br />
            <?php }
                                    }
                                } ?>
            <br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="vizualizare_partener.php">Index Partener</a>
        </div>
    </form>
</body>

</html>

