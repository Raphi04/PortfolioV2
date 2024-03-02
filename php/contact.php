<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="../style.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="../ressources/favicon.png">
        <title>Portfolio | Raphael Cadete</title>
    </head>
    <body>
        <style>
            body {
                margin-top: 90px;
            }

            section {
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            #aPropos h2 {
                margin-bottom: 30px;
            }
        </style>
        <header id="menu-desktop">
            <a href="../index.html#">Raphael Cadete</a>
            <nav>
                <a href="../index.html#accueil" class="headerLink activeHeader" id="nav-accueil">Accueil</a>
                <a href="../index.html#aPropos" class="headerLink" id="nav-aPropos">À propos</a>
                <a href="../index.html#portfolio" class="headerLink" id="nav-portfolio">Portfolio</a>
            </nav>
            <a class="darkRedButton" href="contact.php">Me contacter</a>
        </header>
        <header id="menu-phone">
            <a href="../index.html#">Raphael Cadete</a>
            <i id="menuIcon" class="fa-solid fa-bars" onClick="Menu()"></i>
            <nav id="menu-collapse" class="displayNone opacityNone">
                <ul>
                    <li><a href="../index.html#accueil" onClick="Menu()">Accueil</a></li>
                    <li><a href="../index.html#aPropos" onClick="Menu()">À propos</a></li>
                    <li><a href="../index.html#portfolio" onClick="Menu()">Portfolio</a></li>
                    <li><a href="contact.php" onClick="Menu()">Me contacter</a></li>
                </ul>
            </nav>
        </header>
        <section id="aPropos" data-sectionName="aPropos">
            <h2>En cours de développement</h2>
            <a tabindex="0" href="../ressources/CV_Cadete_Raphael.pdf" target="_blank">Plus d'informations sur mon CV</a>
        </section>
    </body>
</html>
