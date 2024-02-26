<?php
    session_start(); 
    if(array_key_exists("logged",$_SESSION)){
        if($_SESSION["logged"]=="true"){
            ?>
            <!DOCTYPE html>
                <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" type="text/css" href="../styles/materiel.css">
                    <link rel="stylesheet" text="text/css" href="../styles/headerFooter.css">
                    <title>Mes réservations</title>
                    <link rel="icon" type="image/x-icon" href="../ressources/gustaveLogo.png">
                </head>
                <body>
                <header>
                        <a href="materiel.php"><img id="home" src="../ressources/gustaveBlanc.png" alt="LogoGustaveEiffel" title="Gustave Eiffel"/></a>
                        <nav>
                            <article id="compte" onClick="menu()">
                                <p id="nameHeader"><?php echo $_SESSION["prenom"]." ".$_SESSION["nom"];?></p>
                                <img id="user" src="../ressources/utilisateur.png" alt="Mon compte" title="Mon compte">
                            </article>
                        </nav>
                        <article id="menu">
                            <!--SI ON A LE TEMPS: MON COMPTE (POUR MODIF LES INFOS)-->
                            <?php if($_SESSION["role"]=="admin"){
                                echo '<a href="gestionReserv.php"><p id="menuStart">Gestion des réservations</p></a>';
                                echo '<a href="mesReserv.php"><p class="menuContent">Mes réservations</p></a>';
                            }else{
                                echo '<a href="mesReserv.php"><p id="menuStart">Mes réservations</p></a>';
                            }?>
                            <a href="logOut.php"><p id="logout">Se déconnecter</p></a>
                        </article>
                    </header>
                    <section id="content">
                        <form  id="recherche" action="materiel.php" method=post>
                            <input id="searchInput" type="text" placeholder="Recherche" name="search"/>
                            <input id="searchMit" type="submit" value="Rechercher"/>
                        </form>
                    <?php
                    include "../includes/dataBase.php";
                    //Test de la barre de recherche
                    if(!empty($_POST["search"])){
                        //Pagination (aidé par une vidéo: youtube.com/watch?v=1fMPD2dzmPQ&ab_channel=MohamedChiny)
                        //Nombre d'entrée dans la base de donnée après recherche
                        $getCountSQL = 'SELECT count(nom) as count FROM article WHERE nom LIKE "'.$_POST["search"].'%"';
                        $getCount = $db->prepare($getCountSQL);
                        $getCount->execute() or die($db->errorInfo());
                        $result = $getCount->fetchAll(PDO::FETCH_ASSOC);

                        //Définition de la pagination
                        if(array_key_exists("page",$_POST)){
                            $page = $_POST["page"];
                        }else{
                            $page = 1;
                        }
                        $nbItems = $result[0]["count"];
                        $itemsPP = 4;
                        $nbPages=ceil($nbItems/$itemsPP);
                        $init=($page-1)*$itemsPP;

                        //Récupération des données
                        $getSearchSQL = 'SELECT * FROM article WHERE nom LIKE "'.$_POST["search"].'%" limit '.$init.','.$itemsPP;
                        $getSearch = $db->prepare($getSearchSQL);
                        $getSearch->execute() or die($db->errorInfo());
                        $results = $getSearch->fetchAll(PDO::FETCH_ASSOC);
                        
                        //Affichage des produits
                        if(!array_key_exists("0",$results)){
                            echo '<p id="notFound">Aucun résultats pour : '.$_POST["search"].'</p>';
                        }else{
                            include "../includes/affichage.php";
                        }
                    }else{
                        //Pagination (aidé par une vidéo: youtube.com/watch?v=1fMPD2dzmPQ&ab_channel=MohamedChiny)
                        //Nombre d'entrée dans la base de donnée
                        $getCountSQL = "SELECT count(nom) as count FROM article";
                        $getCount = $db->prepare($getCountSQL);
                        $getCount->execute() or die($db->errorInfo());
                        $result=$getCount->fetchAll(PDO::FETCH_ASSOC);
                        //Définition de la pagination
                        if(array_key_exists("page",$_POST)){
                            $page=$_POST["page"];
                        }else{
                            $page=1;
                        }
                        $nbItems = $result[0]["count"];
                        $itemsPP=4;
                        $nbPages=ceil($nbItems/$itemsPP);
                        $init=($page-1)*$itemsPP;

                        //Récupération des données
                        $getMaterielSQL = "SELECT * FROM article ORDER BY type limit $init, $itemsPP";
                        $getMateriel = $db->prepare($getMaterielSQL);
                        $getMateriel->execute() or die($db->errorInfo());
                        $results = $getMateriel->fetchAll(PDO::FETCH_ASSOC);

                        //Affichage des produits
                        include "../includes/affichage.php";

                        //Affichage de la pagination
                        echo '<section id="pagination">';
                        for($i=1; $i<=$nbPages;$i++){
                            if($i==$page){
                                echo '<form action="materiel.php" method=post>';
                                    echo '<input name="page" type="hidden" value="'.$i.'">';
                                    echo '<input class="pagiButtonHere" type="submit" value="'.$i.'">';
                                echo '</form>';
                            }else{
                                echo '<form action="materiel.php" method=post>';
                                    echo '<input name="page" type="hidden" value="'.$i.'">';
                                    echo '<input class="pagiButton" type="submit" value="'.$i.'">';
                                echo '</form>';
                            }
                        }
                        echo '</section>';
                    }
                    ?>
                        </section>
                        <section id="prefooter">
                            <?php if($_SESSION["role"]=="admin"){echo '<a href="ajoutMateriel.php"><p class="footerButton">Ajouter</p></a>';}?>
                        </section>
                        <?php include "../includes/footer.php";?>
                        <script src="../scripts/header.js"></script>
                    </body>
                    </html>
                    <?php
        }else{
            header("location:../index.php");
            exit();
        }
    }else{
        header("location:../index.php");
        exit();
    }
?>