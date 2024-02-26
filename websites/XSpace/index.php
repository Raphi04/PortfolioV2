<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="styles/footer.css" rel="stylesheet" type="text/css">
    <title>XSpace</title>
    <link rel="icon" type="image/x-icon" href="ressources/favicon.png">

</head>
<body>
    <section id="content">
        <section id="accueil">
            <section id="opacity">
                <header>
                    <a href="index.php"><img src="ressources/XSpaceLogo.png" alt="XSpace" title="XSpace"></a>
                    <nav>
                        <a href="pages/actualite.php"><p>Actualité</p></a>
                        <a href="pages/aPropos.php"><p>À propos</p></a>
                        <a href="pages/contact.php"><p>Contact</p></a>
                    </nav>
                </header>
                <section id="main">
                    <section id="title">
                        <h1>Voyager où vous voulez, quand vous voulez.</h1>
                        <img id="deco1" src="ressources/Decoration.png">
                        <img id="deco2" src="ressources/Decoration.png">
                    </section>
                    <section id="download">
                        <a href="https://play.google.com/"><img src="ressources/GooglePlay.png" alt="Google Play" title="Google Play"></a>
                        <a href="https://www.apple.com/fr/app-store/"><img src="ressources/AppleStore.png" alt="Apple Store" title="Apple Store"></a>
                    </section>
                </section>
                <section id="down" onClick="movetoPresentation()">
                    <img src="ressources/Arrow.png" alt="Descendre" title="Descendre">
                </section>
            </section>
        </section>
        <section id="presentation">
            <article>
                <p id="accroche">XSpace est une entreprise spécialisée dans le développement de machines de téléportation.</p>
            </article>
            <section id="details">
                <article class="detailsContainer">
                    <img id="logoPres" src="ressources/XSpaceLogo.png" alt="XSpace" title="XSpace"> 
                </article>
                <article class="detailsContainer">  
                    <p>Notre objectif est simple : proposer un  service de transport rapide, utilisant la haute technologie, afin de permettre à n'importe qui de voyager où il le souhaite. Ainsi, nous espérons  révolutionner la société à l'échelle mondiale.</p>
                </article>
            </section>
        </section>
        <section id="multiContent">
            <article id="video">
                <video controls height="90%" width="90%" loop autoplay muted>
                    <source src="ressources/Scénario3.mp4" type="video/mp4">
                </video>
            </article>
            <section id="aside">
                <a  href="pages/actualite.php">
                    <article id="head">
                        <p>News</p>
                    </article>
                </a>
                <section id="news">
                    <a href="pages/actualite.php#article1"><img src="ressources/xspaceRaphi.jpg" alt="Affiche XSpace Raphael"></a>
                    <a href="pages/actualite.php#article2"><img src="ressources/xspaceHugo.jpg" alt="Affiche XSpace Hugo"></a>
                    <a href="pages/actualite.php#article3"><img src="ressources/xspaceInes.png" alt="Affiche XSpace Hugo"></a>
                    <a href="pages/actualite.php#article4" id="lastAffiche"><img src="ressources/xspaceMarjorie.jpg" alt="Affiche XSpace Hugo"></a>
                </section>
            </section>
        </section>
    </section>
    <?php 
    $page="Accueil";
    include "includes/footer.php";
    generateFooter();
    ?>
    <script src="scripts/accueil.js"></script>
</body>
</html>