<?php
// connectare bazadedate 
include("Conectare.php");

//Modificare datelor 
// se preia id din pagina vizualizare 
$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        // verificam daca id-ul din URL este unul valid  
        if (is_numeric($_POST['id'])) {
            // preluam variabilele din URL/form  
            $id = $_POST['id'];
            $id_eveniment = htmlentities($_POST['id_eveniment'], ENT_QUOTES);
            $nume_sesiune = htmlentities($_POST['nume_sesiune'], ENT_QUOTES);
            $ora_inceput = htmlentities($_POST['ora_inceput'], ENT_QUOTES);
            $ora_sfarsit = htmlentities($_POST['ora_sfarsit'], ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
            $data_eveniment = htmlentities($_POST['data_eveniment'], ENT_QUOTES);

            // verificam daca campurile nu sunt goale  
            if ($id_eveniment == '' || $nume_sesiune == '' || $ora_inceput == '' || $ora_sfarsit == '' || $descriere == '' || $data_eveniment == '') {
                // daca sunt goale afisam mesaj de eroare    
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                // daca nu sunt erori se face update in agenda
                if ($stmt = $mysqli->prepare("UPDATE agenda SET ID_Eveniment=?, Nume_Sesiune=?, Ora_Inceput=?, Ora_Sfarsit=?, Descriere=?, Data_Eveniment=? WHERE ID_Agenda='" . $id . "'")) {
                    $stmt->bind_param("isssss", $id_eveniment, $nume_sesiune, $ora_inceput, $ora_sfarsit, $descriere, $data_eveniment);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        } else {
            // daca variabila 'id' nu este valida, afisam mesaj de eroare 
            echo "id incorect!";
        }
    }
}

// Afiseaza formularul de modificare
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
    } else {
        echo "Adaugare Inregistrare Noua";
    } ?></h1>

    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>

    <form action="" method="post">
        <div>
        <?php if (isset($_GET['id']) && $_GET['id'] != '') { ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <p>ID: <?php echo $_GET['id'];
                        if ($result = $mysqli->query("SELECT * FROM agenda where ID_Agenda='" . $_GET['id'] . "'")) {
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_object(); ?></p>
                                <strong>ID Eveniment: </strong> <input type="text" name="id_eveniment" value="<?php echo $row->ID_Eveniment; ?>" /><br />
                                <strong>Nume Sesiune: </strong> <input type="text" name="nume_sesiune" value="<?php echo $row->Nume_Sesiune; ?>" /><br />
                                <strong>Ora Inceput: </strong> <input type="text" name="ora_inceput" value="<?php echo $row->Ora_Inceput; ?>" /><br />
                                <strong>Ora Sfarsit: </strong> <input type="text" name="ora_sfarsit" value="<?php echo $row->Ora_Sfarsit; ?>" /><br />
                                <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->Descriere; ?>" /><br />
                                <strong>Data Eveniment: </strong> <input type="text" name="data_eveniment" value="<?php echo $row->Data_Eveniment; ?>" /><br />
            <?php }
                        }
                    } ?>
            <br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="vizualicare_agenda.php">Index</a>
        </div>
    </form>
</body>

</html>
