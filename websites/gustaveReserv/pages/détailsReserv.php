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
                    <link rel="stylesheet" type="text/css" href="../styles/détailsReserv.css">
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
                            <?php if($_POST["where"]=="mesReserv"){
                                echo '<a href="mesReserv.php"><p class="arriane">Mes réservations</p></a>';
                            }else{
                                echo '<a href="gestionReserv.php"><p class="arriane">Gestion des réservations</p></a>';
                            }?>
                            <p class="arriane">></p>
                            <p class="arriane">Détails des réservations</p>
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
                    if(array_key_exists("where",$_POST)){  
                        include "../includes/dataBase.php";
                        include "../includes/form.php"; 
                        if(array_key_exists("traitement", $_POST)){
                            if($_POST["traitement"]=="Accepter"){
                                $success=0;
                                $error=0;
                                $getReservationsSql = "SELECT debut, fin FROM reservation WHERE reference=:reference AND statut='Accepté'";
                                $getReservations = $db->prepare($getReservationsSql);
                                $sqlParameter=[
                                    "reference"=>$_POST["reference"]
                                ];
                                $getReservations->execute($sqlParameter) or die($db->errorInfo());
                                $results = $getReservations->fetchAll(PDO::FETCH_ASSOC);
                                $bdDebut = array();
                                $bdFin = array();
                                foreach($results as $value){
                                    $bdDebut[]=$value["debut"];
                                    $bdFin[]=$value["fin"];
                                }
                                if(count($bdDebut)==0){
                                    $accepteSql = "UPDATE reservation SET statut = 'Accepté' WHERE numero=:numero";
                                    $accepte = $db->prepare($accepteSql);
                                    $sqlParameter=[
                                        "numero" => $_POST["numero"]
                                    ];
                                    $accepte->execute($sqlParameter) or die($db->errorInfo());
                                    header("location:gestionReserv.php?traitement=nonTraité");
                                    exit();
                                }else{
                                    for($i=0; $i<count($bdDebut); $i++){
                                        if($_POST["debut"]<$bdDebut[$i] and $_POST["fin"]<$bdFin[$i]){
                                            $success++;
                                        }elseif($_POST["debut"]>$bdFin[$i]){
                                            $success++;
                                        }else{
                                            $error++;
                                        }
                                    }
                                    if($error>0){
                                        détailsReservForm();
                                    }else{
                                        $accepteSql = "UPDATE reservation SET statut = 'Accepté' WHERE numero=:numero";
                                        $accepte = $db->prepare($accepteSql);
                                        $sqlParameter=[
                                            "numero" => $_POST["numero"]
                                        ];
                                        $accepte->execute($sqlParameter) or die($db->errorInfo());
                                        header("location:gestionReserv.php");
                                        exit(); 
                                    }
                                }
                            }elseif($_POST["traitement"]=="Refuser"){
                                $refuseSql = "UPDATE reservation SET statut = 'Refusé' WHERE numero=:numero";
                                $refuse = $db->prepare($refuseSql);
                                $sqlParameter=[
                                    "numero" => $_POST["numero"]
                                ];
                                $refuse->execute($sqlParameter) or die($db->errorInfo());
                                header("location:gestionReserv.php");
                                exit(); 
                            }else{
                                $annuleSql= "DELETE FROM reservation WHERE numero = :numero";
                                $annule = $db->prepare($annuleSql);
                                $sqlParameter=[
                                    "numero" => $_POST["numero"]
                                ];
                                $annule->execute($sqlParameter) or die($db->errorInfo());
                                header("location:mesReserv.php");
                                exit();
                            }
                        }else{
                            détailsReservForm();
                        }
                        ?>
                        <section id="prefooter">
                        </section>
                        <?php include "../includes/footer.php";?>
                        <script src="../scripts/header.js"></script>
                    </body>
                    </html>
                    <?php
            }else{
                header("location:materiel.php");
                exit();
            }
        }else{
            header("location:../index.php");
            exit();
        }
    }else{
        header("location:../index.php");
        exit();
    }
?>