<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../styles/aPropos.css" rel="stylesheet" type="text/css">
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
            <a href="aPropos.php" id="here"><p>À propos</p></a>
            <a href="contact.php"><p>Contact</p></a>
        </nav>
    </header>
    <section id="content">
        <article class="section" id="lastArticle">
            <h2>Qui sommes-nous</h2>
            <p>Nous sommes une équipe d'ingénieurs sortie depuis quelques années de la Waldorf School of the Peninsula et travaillant actuellement en collaboration avec la NASA.</p>
            <p>Après avoir terminé nos études, notre équipe s'est donnée pour objectif de rendre accessible au plus grand nombre, la possibilité de voyager partout à moindre coût. C'est ainsi que le projet XSpace a vu le jour.</p>
            <p>Une fois l'entreprise XSpace fondée, nous avons développée une application du même nom qui vous permettra de vous téléporter depuis votre téléphone, où vous voulez et quand vous voulez, partout dans le monde.</p>
            <p>Notre application est disponible sur toutes les plateformes de téléchargement sur IOS et Android.</p>
        </article>
        <article class="section bgBlack">
            <h2>Sécurité</h2>
            <p>Notre système de téléportation a subit de nombreux tests pour arriver à ce qu'il est aujourd'hui. Il s'agit d'un moyen de locomotion aussi sûr que l'aviation et est également certifié par l’OMS comme ne présentant aucun risque pour la santé de ses utilisateurs.</p>
            <hr>
        </article>
        <article class="section bgBlack">
            <h2>Écologie</h2>
            <p>L'écologie prend également une part très importante dans ce projet. Notre but était avant tout de proposer un moyen de transport rapide et  écologique, et c'est ce que nous avons fait. En effet, cette technologie utilise des matériaux 100% recyclables et à pour unique source d'énergie:  l'électricité.</p>
            <hr>
        </article>
        <article class="section bgBlack" id="lastArticle">
            <h2>Économie</h2>
            <p>XSpaceest également très intéressante d'un point de vue financier : pour seulement 45 euros par mois, vous pouvez voyager où vous voulez en un seul clic. Devenant le moyen de transport le plus rentable du monde,  notre application saura se faire une place à vos côté. Ainsi, XSpace est la première étape vers un monde meilleur.</p>
        </article>
        <section class="section" id="teamContainer">
            <h2>Notre Équipe</h2>
            <section id="team">
                <article>
                    <img src="../ressources/RaphaelCadete.jpg" atl="Photo de Raphael">
                    <p>Raphael Cadete</p>
                </article>
                <article>
                    <img src="../ressources/HugoBajoue.jpg" atl="Photo de Hugo">
                    <p>Hugo Bajoue</p>
                </article>
                <article>
                    <img src="../ressources/InesTemmar.jpg" atl="Photo d'Ines">
                    <p>Ines Temmar</p>
                </article>
                <article>
                    <img src="../ressources/MarjoriePili.jpg" atl="Photo de Marjorie">
                    <p>Marjorie Pili</p>
                </article>
            </section>
        </section>
    </section>
    <?php
    include "../includes/footer.php";
    generateFooter();
    ?>
</body>
</html>