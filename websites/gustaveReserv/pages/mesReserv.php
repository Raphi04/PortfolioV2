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
                    <link rel="stylesheet" type="text/css" href="../styles/mesReserv.css">
                    <link rel="stylesheet" text="text/css" href="../styles/headerFooter.css">
                    <title>Mes réservations</title>
                    <link rel="icon" type="image/x-icon" href="../ressources/gustaveLogo.png">
                </head>
                <body>
                <header>
                        <a href="materiel.php"><img id="home" src="../ressources/gustaveBlanc.png" alt="LogoGustaveEiffel" title="Gustave Eiffel"/></a>
                        <nav>
                            <a href="materiel.php"><img src="../ressources/homeblanc.png" alt="Accueil" title="Accueil" class="arriane" id="homeBlanc"></a>
                            <p class="arriane">></p>
                            <p class="arriane">Mes réservations</p>
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
                    <?php
                        include "../includes/dataBase.php";
                        //Pagination (aidé par une vidéo: youtube.com/watch?v=1fMPD2dzmPQ&ab_channel=MohamedChiny)
                        //Nombre d'entrée dans la base de donnée
                        $getCountSQL = "SELECT count(debut) as count FROM reservation WHERE mail=:mail";
                        $getCount = $db->prepare($getCountSQL);
                        $sqlParameter=[
                            "mail"=>$_SESSION["mail"]
                        ];
                        $getCount->execute($sqlParameter) or die($db->errorInfo());
                        $result=$getCount->fetchAll(PDO::FETCH_ASSOC);
                        //Définition de la pagination
                        if(array_key_exists("page",$_POST)){
                            $page=$_POST["page"];
                        }else{
                            $page=1;
                        }
                        $nbItems = $result[0]["count"];
                        $itemsPP=5;
                        $nbPages=ceil($nbItems/$itemsPP);
                        $init=($page-1)*$itemsPP;


                        //Récupération des infos de réservation
                        $getReservSql = "SELECT * FROM reservation WHERE mail=:mail ORDER BY debut DESC, statut ASC limit $init, $itemsPP";
                        $getReserv = $db->prepare($getReservSql);
                        $sqlParameter=[
                            "mail" => $_SESSION["mail"]
                        ];
                        $getReserv->execute($sqlParameter) or die($db->errorInfo());
                        $results=$getReserv->fetchAll(PDO::FETCH_ASSOC);
                        $reference = array();
                        foreach($results as $value){
                            $debut[]=$value["debut"];
                            $fin[]=$value["fin"];
                            $reference[]=$value["reference"];
                            $mail[]=$value["mail"];
                            $statut[]=$value["statut"];
                            $numero[]=$value["numero"];
                        }
                        if(count($reference)==0){
                                echo"<p id='notFound'>Vous n'avez aucune réservation ou de demande en cours de traitement</p>";
                        }else{
                            foreach($reference as $key=>$value){
                                $getNameSql = "SELECT nom FROM article WHERE reference=:reference";
                                $getName = $db->prepare($getNameSql);
                                $sqlParameter=[
                                    "reference" => $value
                                ];
                                $getName->execute($sqlParameter) or die($db->errorInfo());
                                $result=$getName->fetchAll(PDO::FETCH_ASSOC);
                                $nom[]=$result[0]["nom"];
                            }
                            ?>
                                <section id="tabHead">
                                    <article id="nomHead">
                                        <p>Nom du matériel</p>
                                    </article>
                                    <article id="referenceHead">
                                        <p>Référence</p>
                                    </article>
                                    <article class="dateHead">
                                        <p>Date de début</p>
                                    </article>
                                    <article class="dateHead">
                                        <p>Date de fin</p>
                                    </article>
                                    <article id="numeroHead">
                                        <p>N° réservation</p>
                                    </article>
                                    <article id="statutHead">
                                        <p>Statut</p>
                                    </article>
                                </section>
                            <?php
                            for($i=0; $i<count($debut); $i++){
                                $recompD=explode("-", $debut[$i]);
                                $debut[$i]=$recompD[2]."/".$recompD[1]."/".$recompD[0];
                                $recompF=explode("-", $fin[$i]);
                                $fin[$i]=$recompF[2]."/".$recompF[1]."/".$recompF[0];

                                ?>
                                <section class="reservationContainer">
                                    <section class="reservation">
                                        <article id="nom">
                                            <p><?php echo $nom[$i]; ?></p>
                                        </article>
                                        <article id="reference">
                                            <p><?php echo $reference[$i]?></p>
                                        </article>
                                        <article class="date">
                                            <p><?php echo $debut[$i]?></p>
                                        </article>
                                        <article class="date">
                                            <p><?php echo $fin[$i]?></p>
                                        </article>
                                        <article id="numero">
                                            <p><?php echo $numero[$i]?></p>
                                        </article>
                                        <article id="statut">
                                            <p><?php echo $statut[$i]?></p>
                                        </article>
                                    </section>
                                    <form action="détailsReserv.php" method="post">
                                        <input type="hidden" value="mesReserv" name="where">
                                        <input type="hidden" value="<?php echo $numero[$i]?>" name="numero">
                                        <input type="submit" class="details" value="Détails"/>
                                    </form>
                                </section>
                                <?php
                            }
                        //Affichage de la pagination
                            echo '<section id="pagination">';
                            for($i=1; $i<=$nbPages;$i++){
                                echo '<form action="mesReserv.php" method=post>';
                                    echo '<input name="page" type="hidden" value="'.$i.'">';
                                    echo '<input class="pagiButton" type="submit" value="'.$i.'">';
                                echo '</form>';
                            }
                            echo '</section>';
                        }
                        ?>
                            </section>
                            <section id="prefooter">
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