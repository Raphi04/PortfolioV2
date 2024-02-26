<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../styles/actualite.css" rel="stylesheet" type="text/css">
    <link href="../styles/header.css" rel="stylesheet" type="text/css">
    <link href="../styles/footer.css" rel="stylesheet" type="text/css">
    <title>XSpace - Actualité</title>
    <link rel="icon" type="image/x-icon" href="wp-content/themes/XSpace/ressources/favicon.png">
</head>
<body>
    <header>
        <a href="../../../../"><img src="../ressources/XSpaceLogo.png" alt="Logo de XSpace" title="Accueil"></a>
        <nav>
            <a href="actualite.php" id="here"><p>Actualité</p></a>
            <a href="aPropos.php"><p>À propos</p></a>
            <a href="contact.php"><p>Contact</p></a>
        </nav>
    </header>
    <section id="content">
        <section class="article" id="article1">
            <article class="articleIMG">
                <img src="../ressources/xspaceRaphi.jpg" atl="Affiche XSpace Raphael">
            </article>

            <article class="articleTEXT">
                <h2>Travel where you want with XSpace !</h2>
                <p class="author">Writed by : Raphael Cadete</p>
                <p class="chapot">We are launching an application that allows you to teleport everywhere and anywhere you want, simply by using your smartphone.</p>
                <p class="description">How can it be that simple? Our experts have worked during 20 years to make it possible to anyone on Earth.<br><br>Our technology uses the front camera of your phone to analyze your current position before teleporting you where you want to go.<br><br>Approved by the World Health Organization, XSpace can be downloaded on Google Store and AppStore.</p>
            </article>
        </section>
        <hr>
        <section class="article" id="article2">
            <article class="articleTEXT2">
                <h2>Teleport yourself and discover the world</h2>
                <p class="author">Writed by : Hugo Bajoue</p>
                <p class="chapot">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </article>

            <article class="articleIMG2">
                <img src="../ressources/xspaceHugo.jpg" atl="Affiche XSpace Raphi">
            </article>
        </section>
        <hr>
        <section class="article" id="article3">
            <article class="articleIMG">
                <img src="../ressources/xspaceInes.png" atl="Affiche XSpace Ines">
            </article>

            <article class="articleTEXT">
                <h2>Travel somewhere, anywhere, everywhere</h2>
                <p class="author">Writed by : Ines Temmar</p>
                <p class="chapot">Have you ever felt lazy to go from one place to another? Or would you like to go on a trip in one moment? Now you can!</p>
                <p class="description">Xspace presents you his new teleportation service on demand.<br><br>With this one, you can go :<br>- somewhere<br>- anywhere<br>- everywhere<br><br>And you, how do you go on a trip this summer?</p>
            </article>
        </section>
        <hr>
        <section class="article" id="article4">
            <article class="articleTEXT2">
                <h2>Step into a new travel era with XSpace!</h2>
                <p class="author">Writed by : Marjorie Pili</p>
                <p class="chapot">Experience a greener, faster, and safer way to explore the world.</p>
                <p class="description">Forget long flights and waiting times - with XSpace, you can instantly teleport to any destination. <br><br>Let's redefine travel and create unforgettable experiences without harming our planet. <br><br>Join us on August 1st, 2025, for the launch of our revolutionary app. <br><br>Embrace the future of travel with XSpace, where innovation meets adventure!</p>
            </article>

            <article class="articleIMG2">
                <img src="../ressources/xspaceMarjorie.jpg" atl="Affiche XSpace Marjorie">
            </article>
        </section>
    </section>
    <?php
    include "../includes/footer.php";
    generateFooter();
    ?>
</body>
</html>