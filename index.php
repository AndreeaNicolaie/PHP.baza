<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principală</title>
    <style>
        body {
            background-color: #FFC0CB;
            text-align: center;
            padding: 20px;
        }

        .menu-button {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            font-size: 18px;
            background-color: #fff;
            border: 2px solid #FF69B4;
            text-decoration: none;
            color: #FF69B4;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .menu-button:hover {
            background-color: #FF69B4;
            color: #fff;
        }

        .auth-buttons {
            position: absolute;
            top: 15px;
            left: 15px;
        }
    </style>
</head>

<body>
    <div class="auth-buttons">
        <a href="login.html" class="menu-button">Login</a>
        <a href="registration.html" class="menu-button">Register</a>
        <a href="magazin.php" class="menu-button">Cumpara</a>
    </div>
    <h1>Bun venit pe pagina noastră!</h1>
    <div>
        <a href="vizualizare_eveniment.php" class="menu-button">Evenimentele noastre</a>
        <a href="vizualizare_sesiune.php" class="menu-button">Sesiunile Evenimentelor</a>
        <a href="vizualizare_partener.php" class="menu-button">Parteneri</a>
        <a href="vizualizare_sponsor.php" class="menu-button">Sponsori</a>
        <a href="vizualizare_speaker.php" class="menu-button">Speakerii noștri</a>
        <a href="vizualizare_speaker_sesiune.php" class="menu-button">Speakerii + Sesiunea la care îi regăsiți</a>
        <a href="vizualizare_bilet.php" class="menu-button">Bilete</a>
        <a href="vizualizare_agenda.php" class="menu-button">Agenda Evenimentului</a>
    </div>
</body>
</html>