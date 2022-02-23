<?php
session_start();
var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="./js/main.js"></script>
</head>

<body>
    <nav>
        <li><a href="index.php?page=accueil">Accueil</a></li>
        <li><a href="index.php?page=panier">Panier</a></li>
    </nav>

    <main>
        <?php
        if (isset($_GET["page"])) {
            if (file_exists("php/pages/" . $_GET["page"] . ".php")) {
                include "php/pages/" . $_GET["page"] . ".php";
            }
        } else {
            include "php/pages/accueil.php";
        }
        ?>
    </main>

</body>

</html>