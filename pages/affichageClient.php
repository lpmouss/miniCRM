<?php 
        session_start(); 

        if(!isset($_SESSION['us'])){
            header("location:authentification.php");
        }
/*require_once('Database.php');
require_once('clientpoo.php');*/

require_once('configuration.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!--<script type="text/javascript" src="bootstable/bootstable.js"></script>-->
    <script type="text/javascript" src="../assets/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../assets/js/boostrap.js"></script>

    <!--<link href="../css/bootstrap-editable.css" rel="stylesheet">
    <script src="../js/bootstrap-editable.min.js"></script>-->

    <style>
        body {
            font-family: "Trebuchet MS", sans-serif;
        }

        .farid {
            font-family: "lucida console", sans-serif;
            font-size: 20px;
        }

        .col-lg-3 {
            position: relative;
            margin-left: 400px;
            margin-top: 60px;
        }

        .bar {
            position: absolute;
            text-align: right;
        }

    </style>
</head>

<body>
    <?php include('menu.php'); ?>

    <!--########################### AFFICHAGE DES CLIENTS #########################################-->
    <div class="container">
        <div class="panel panel-success marge60 col-md-4 col-md-offset-4">
            <div class="panel-heading">Rechercher les clients</div>
            <div class="panel-body">

                <form method="GET" action="affichageClient.php" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="rechercheClient" placeholder="nom ou prenom" class="form-control">
                        <div class="input-group-btn form-inline">
                            <button class="btn btn-danger" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                    <!--<button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-search"></span>
                        CHERCHER 
                    </button> -->&nbsp; &nbsp;
                    <!--**************-->
                    <?php 
                         if(isset($_GET['rechercheClient'])){
                            $tape = $_GET['rechercheClient'];
                         }else{
                                $tape="";
                             }
                    
                    /*$page=1;
                    $limite=5;*/
                    
                    
                    
                    $limite=isset($_GET['limite'])?$_GET['limite']:5;
                    $page=isset($_GET['page'])?$_GET['page']:1;
                    $defaut = ($page - 1)*$limite;
                    
                    /* Requête pour afficher tous les clients y compris les critères de recherche*/
                    $sql="select * from membre where name like '%$tape%' limit $limite offset $defaut";
                    /*  Requête pour compter le nombre des clients enregistré */
                    $sqlCompteur="select count(*) compteur from membre where name like '%$tape%'";
                    
                    $resultatCompteur = mysqli_query($connexion,$sqlCompteur);
                    $tableauCompteur = mysqli_fetch_assoc($resultatCompteur);
                    
                    $nombre=$tableauCompteur['compteur'];
                    
                   
                    
                    $reste = $nombre % $limite; /*reste de la division euclidienne du $nombre par $limite*/
                    
                    if($reste === 0){  
                        $pageNombre = $nombre/$limite;
                    }else{
                        $pageNombre = floor($nombre/$limite)+1; /*Floor est une methode permettant de retourner
                                                                        la partie entière
                                                                        +1 pour la page suivante'*/
                    }
                    ?>


                    <!--**************-->
                    <!--<a href="client.php" class="glyphicon glyphicon-plus">Ajouter</a>-->
                </form>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel panel-primary marge20">
            <div class="panel-heading">
                <center><span class="farid">Liste des clients [<?php echo $tableauCompteur['compteur'] ?> clients]</span></center>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                N°
                            </th>
                            <th>
                                <center>NOM PRENOM</center>
                            </th>
                            <th>
                                <center>DATE DE NAISSANCE</center>
                            </th>
                            <th>
                                <center>LIEU DE NAISSANCE</center>
                            </th>
                            <th>
                                <center>ADRESSE</center>
                            </th>
                            <th>
                                <center>TELEPHONE</center>
                            </th>
                            <th>
                                <center>ACTIONS</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   $num = 0;
                                    $resultat=mysqli_query($connexion,$sql);
                                        while($ligne=mysqli_fetch_assoc($resultat)){ 
                                            $num++; 
                                
                        ?>
                        <tr>
                            <td>
                                <?= $num ?>
                            </td>
                            <td>
                                <center>
                                    <?php echo strtoupper($ligne['name'])?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php echo $ligne['date_nais']?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php echo $ligne['lieu_nais']?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php echo $ligne['adress']?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php echo $ligne['telephone']?>
                                </center>
                            </td>
                            <td>

                                <center>
                                    <a href="modifierClient.php?idclient=<?php echo $ligne['id']?>">
                                       
                                        <span class="glyphicon glyphicon-pencil"> </span>
                                    </a> &nbsp; &nbsp;
                                    <a onclick="return confirm('vous êtes sûr ?')" href="supprimerClient.php?id=<?php echo $ligne['id']?>">
                                       
                                        <span class="glyphicon glyphicon-trash" > </span>
                                    </a>
                                </center>

                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div>
                    <!--########### PAGINATION ###########-->
                    <ul class="pagination">
                        <?php
                        if($page == 1){
                            echo '<li class="page-item disabled"><a class="page-link" href="">Précèdent</a></li>';
                        }
                        if($page>1){
                            echo '<li class="page-item"><a class="page-link" href="affichageClient.php?page=<?php echo $page ?>">Précèdent</a>
                            </li>'; } for($i=1;$i<=$pageNombre;$i++){ ?>

                                <li class="page-item <?php if($page==$i) echo " active " ?>">
                                    <a class="page-link" href="affichageClient.php?page=<?php echo $i?>">
                                        <?php echo $i ?>
                                    </a>
                                </li>
                                <?php 
                                    } 
                                
                                if($page>=$pageNombre){
                                    echo '<li class="page-item disabled"><a class="page-link" href="">Suivant</a></li>';
                                   
                                }else{
                                    echo '<li class="page-item"><a class="page-link" href="affichageClient.php?page=<?php echo $page ?>">Suivant</a>
                                </li>'; } /*if($page<$pageNombre)*/ ?>
                                    <!--href="pagination.php?page=<?page/* echo '$page'*/ ?>"-->


                    </ul>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
