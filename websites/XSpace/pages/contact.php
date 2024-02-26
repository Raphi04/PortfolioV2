<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../styles/contact.css" rel="stylesheet" type="text/css">
    <link href="../styles/header.css" rel="stylesheet" type="text/css">
    <link href="../styles/footer.css" rel="stylesheet" type="text/css">
    <title>XSpace - Actualité</title>
    <link rel="icon" type="image/x-icon" href="wp-content/themes/XSpace/ressources/favicon.png">
</head>
<body>
    <header>
        <a href="../../../../"><img src="../ressources/XSpaceLogo.png" alt="Logo de XSpace" title="Accueil"></a>
        <nav>
            <a href="actualite.php"><p>Actualité</p></a>
            <a href="aPropos.php"><p>À propos</p></a>
            <a href="contact.php" id="here"><p>Contact</p></a>
        </nav>
    </header>
    <section id="content">
        <form action="contact.php" method="post">
        <section id="firstPart">
            <article id="imageContainer">
                <img src="../ressources/XSpaceAppli2.png" alt="Application XSpace">
            </article>
            <?php
                include "../includes/form.php";
                generateForm();
            ?>
            <section id="infos">
                <article>
                    <h2>Contact</h2>
                    <p>contact@xspace.com</p>
                    <p>+18 42 17 70 13 69</p>
                </article>
                <article id="marginH2">
                    <h2>Based in</h2>
                    <p>4 Silver West</p>
                    <p>California 90250</p>
                </article>
            </section>
        </section>
        <section id="secondPart">
            <input type="submit" id="contact" value="CONTACT US"/>
        </section>
        </form>
    </section>
    <?php
    include "../includes/footer.php";
    generateFooter();
    ?>
</body>
</html>