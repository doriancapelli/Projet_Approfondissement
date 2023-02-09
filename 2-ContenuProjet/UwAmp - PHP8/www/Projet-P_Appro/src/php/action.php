<?php
///ETML
///Author      : Dorian Capelli 
///Date        : 06.02.2023
///Description : Page of detail, modify and create a member

    session_start();
    require "dbManage.php";
    $database = new dbManage();
    $error = FALSE;
    $AllErrors = array();

    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
        $user = $_SESSION['userName'];
    }
    else{
        header('Location: login');
        die();
    }

    $action = $_GET['action'];

    if(isset($_GET['idMember'])){
        $idMember = $_GET['idMember'];
    }
    
    $detailDisplay = "None";
    $modifyDisplay = "None";
    $createDisplay = "None";
    $html = "";

    if($action == 1){
        $detailDisplay = "True";
        $member = $database->getOneMember($idMember);
    }
    elseif($action == 2){
        $modifyDisplay = "True";
        $member = $database->getOneMember($idMember);
        $titles = $database->getAllTitle();
        $categorys = $database->getAllCategory();
    }
    elseif($action == 3){
        $createDisplay = "True";
        $titles = $database->getAllTitle();
        $categorys = $database->getAllCategory();
    }
    else{
        header('Location: List-Member');
        die();
    }

    if(isset($_POST['btn'])){
        if($action == 2){
            $action = 1;
            $idMember;
            $memFirstName = $_POST['memFirstName'];
            $memLastName = $_POST['memLastName'];
            $memDateBirth = $_POST['memDateBirth'];
            $memPhoneNumber = $_POST['memPhoneNumber'];
            $memLicencing = $_POST['memLicencing'];
            $memRanking = $_POST['memRanking'];
            $fkTitle = $_POST['fkTitle'];
            $fkCategory = $_POST['fkCategory'];


            if(!preg_match("#^[A-Za-z_ -éèêëàáâãäåìíîïòóôõöùúûüýñç]{3,50}$#", $memFirstName)){
                $error = true;
                $AllErrors[] = "Vérifier le Prénom";
            }

            if(!preg_match("#^[A-Za-z_ -éèêëàáâãäåìíîïòóôõöùúûüýñç]{3,50}$#", $memLastName)){
                $error = true;
                $AllErrors[] = "Vérifier le Nom";
            }

            if(!preg_match("#^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$#", $memPhoneNumber)){
                $error = true;
                $AllErrors[] = "Vérifier le numéro de téléphone";
            }

            if(!preg_match("#^(19[0-9][0-9]|20[0-3][0-9])(-(0[13578]|1[02]))?-(0[1-9]|[12][0-9]|3[01])$|^(19[0-9][0-9]|20[0-3][0-9])-(02)-(0[1-9]|1[0-9]|2[0-8])$|^(19[0-9][0-9]|20[0-3][0-9])-(02)-29$#", $memDateBirth)){
                $error = true;
                $AllErrors[] = "Vérifier la date de naissance";
            }

            if(!($memLicencing == NULL || preg_match("#^[A-Z][0-9]{5}$#", $memLicencing))){
                $error = true;
                $AllErrors[] = "Vérifier la licence";
            }

            if(!($memRanking == NULL) ){
                if(!(preg_match("#^([5-9][0-9]{2}|[1-1][0-9][0-9]{2}|[2-2][0-9][0-9]{2}|[3-3][0-4][0-9]{2}|3500)$#", $memRanking))){
                    $error = true;
                    $AllErrors[] = "Vérifier l'élo";    
                }
            }
            else{
                $memRanking = NULL;
            }

            if(!($fkTitle == 0)){
                if(!(is_numeric($fkTitle) && $fkTitle < 5)){
                    $error = true;
                    $AllErrors[] = "Vérifier le titre";
                }
            }
            else{
                $fkTitle = NULL;
            }

            if(!(is_numeric($fkCategory) && $fkCategory < 10)){
                $error = true;
                $AllErrors[] = "Vérifier la catégorie";
            }

            if(!$error){
                $database->updateMember($idMember, $memLastName, $memFirstName, $memDateBirth, $memPhoneNumber, $memLicencing, $memRanking, $fkTitle, $fkCategory);
                header("Location: action?idMember=$idMember&action=$action");
            }
        }
        elseif($action == 3){
            $action = 1;
            $memFirstName = $_POST['memFirstName'];
            $memLastName = $_POST['memLastName'];
            $memDateBirth = $_POST['memDateBirth'];
            $memPhoneNumber = $_POST['memPhoneNumber'];
            $memLicencing = $_POST['memLicencing'];
            $memRanking = $_POST['memRanking'];
            $fkTitle = $_POST['fkTitle'];
            $fkCategory = $_POST['fkCategory'];

            if(!preg_match("#^[A-Za-z_ -éèêëàáâãäåìíîïòóôõöùúûüýñç]{3,50}$#", $memFirstName)){
                $error = true;
                $AllErrors[] = "Vérifier le Prénom";
            }

            if(!preg_match("#^[A-Za-z_ -éèêëàáâãäåìíîïòóôõöùúûüýñç]{3,50}$#", $memLastName)){
                $error = true;
                $AllErrors[] = "Vérifier le Nom";
            }

            if(!preg_match("#^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$#", $memPhoneNumber)){
                $error = true;
                $AllErrors[] = "Vérifier le numéro de téléphone";
            }

            if(!preg_match("#^(19[0-9][0-9]|20[0-3][0-9])(-(0[13578]|1[02]))?-(0[1-9]|[12][0-9]|3[01])$|^(19[0-9][0-9]|20[0-3][0-9])-(02)-(0[1-9]|1[0-9]|2[0-8])$|^(19[0-9][0-9]|20[0-3][0-9])-(02)-29$#", $memDateBirth)){
                $error = true;
                $AllErrors[] = "Vérifier la date de naissance";
            }

            if(!($memLicencing == NULL || preg_match("#^[A-Z][0-9]{5}$#", $memLicencing))){
                $error = true;
                $AllErrors[] = "Vérifier la licence";
            }

            if(!($memRanking == NULL) ){
                if(!(preg_match("#^([5-9][0-9]{2}|[1-1][0-9][0-9]{2}|[2-2][0-9][0-9]{2}|[3-3][0-4][0-9]{2}|3500)$#", $memRanking))){
                    $error = true;
                    $AllErrors[] = "Vérifier l'élo";    
                }
            }
            else{
                $memRanking = NULL;
            }

            if(!($fkTitle == 0)){
                if(!(is_numeric($fkTitle) && $fkTitle < 5)){
                    $error = true;
                    $AllErrors[] = "Vérifier le titre";
                }
            }
            else{
                $fkTitle = NULL;
            }

            if(!(is_numeric($fkCategory) && $fkCategory < 10)){
                $error = true;
                $AllErrors[] = "Vérifier la catégorie";
            }

            if(!$error){
                $idMember = $database->addMember($memLastName, $memFirstName, $memDateBirth, $memPhoneNumber, $memLicencing, $memRanking, $fkTitle, $fkCategory);
                header("Location: action?idMember=$idMember&action=$action");
            }
        }
    }
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" href="../../resources/images/chess-pawn.png" />
        <?php
            if($action == 1){
                ?>
                <title>Gestion de membre d'un club d'échec - Détails</title>
                <?php
            }
            elseif($action == 2){
                ?>
                <title>Gestion de membre d'un club d'échec - Modifier</title>
                <?php
            }
            elseif($action == 3){
                ?>
                <title>Gestion de membre d'un club d'échec - Ajouter</title>
                <?php
            }
        ?>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../../resources/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" />
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="List-Member">Gestion des Membres d'un Club d'echecs</a>
            <!-- Navbar-->
            <ul class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="List-Member">
                                <div class="sb-nav-link-icon"></div>
                                Liste des membres
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Copyright &copy; Gestion des membres d'un club d'échecs 2023 © Dorian Capelli</div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        </br>
                        <!-- <h1 class="mt-4">Détail d'un membre</h1> -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Détail d'un membre 
                            </div>
                            <div class="card-body">
                                <?php
                                if($detailDisplay == "True"){
                                    #displays all minformation of a members
                                    foreach($member as $detail){
                                        $idMember = $detail['idMember'];

                                        $html = $detail['memFirstName'] ."</br>";
                                        $html .= $detail['memLastName'] ."</br>";
                                        $html .= $detail['memDateBirth'] ."</br>";
                                        $html .= $detail['memPhoneNumber'] ."</br>";
                                        $html .= $detail['memLicencing'] ."</br>";
                                        $html .= $detail['memRanking'] ."</br>";
                                        $html .= $detail['catName'] ."</br>";
                                        $html .= $detail['titName'] ."</br>";
                                        echo $html;
                                    }
                                }
                                elseif($modifyDisplay == "True"){
                                    foreach($member as $detail){
                                        $idMember = $detail['idMember'];
                                        
                                        $memFirstName = $detail['memFirstName'];
                                        $memLastName = $detail['memLastName'];
                                        $memDateBirth = $detail['memDateBirth'];
                                        $memPhoneNumber = $detail['memPhoneNumber'];
                                        $memLicencing = $detail['memLicencing'];
                                        $memRanking = $detail['memRanking'];
                                        $catName = $detail['catName'];
                                        $titName = $detail['titName'];
                                    }
                                    $html =  "<form action='action?idMember=$idMember&action=$action' method='post'>";
                                        $html .= "<label for='memFirstName'>Prénom:</label><br>";
                                        $html .= "<input name='memFirstName'pattern='^[A-Za-z_ -éèêëàáâãäåìíîïòóôõöùúûüýñ]{3,50}$' type='text' id='memFirstName' value='$memFirstName' required><br>";
                                        $html .= "<label for='memLastName'>Nom:</label><br>";
                                        $html .= "<input name='memLastName' pattern='^[A-Za-z_ -éèêëàáâãäåìíîïòóôõöùúûüýñ]{3,50}$' type='text' id='memLastName' value='$memLastName' required><br>";
                                        $html .= "<label for='memDateBirth'>Date de naissance:</label><br>";
                                        $html .= "<input name='memDateBirth' pattern='^(19[0-9][0-9]|20[0-3][0-9])(-(0[13578]|1[02]))?-(0[1-9]|[12][0-9]|3[01])$|^(19[0-9][0-9]|20[0-3][0-9])-(02)-(0[1-9]|1[0-9]|2[0-8])$|^(19[0-9][0-9]|20[0-3][0-9])-(02)-29$' type='date' id='memDateBirth' value='$memDateBirth' ><br>";
                                        $html .= "<label for='memPhoneNumber'>Numéro de téléphone:</label><br>";
                                        $html .= "<input name='memPhoneNumber' pattern='^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$' type='text' id='memPhoneNumber' value='$memPhoneNumber' required><br>";
                                        $html .= "<label for='memLicencing'>Licence:</label><br>";
                                        $html .= "<input name='memLicencing' pattern='^[A-Z][0-9]{5}$' type='text' id='memLicencing' value='$memLicencing'><br>";
                                        $html .= "<label for='memRanking'>Elo:</label><br>";
                                        $html .= "<input name='memRanking' pattern='^([5-9][0-9]{2}|[1-1][0-9][0-9]{2}|[2-2][0-9][0-9]{2}|[3-3][0-4][0-9]{2}|3500)$' type='number' id='memRanking' value='$memRanking'><br>";
                                        $html .= "<select name='fkTitle' id='fkTitle'>";
                                        $html .= "<option value='0' selected>--Choisissez un titre--</option>'>";
                                            foreach($titles as $title){
                                                if(isset($titName) and ($titName == $title['titName'])){
                                                    $html .= "<option value='" . $title['idTitle'] . "' selected>" . $title['titName'] . "</option>";
                                                }
                                                else{
                                                    $html .= "<option value='" . $title['idTitle'] . "'>" . $title['titName'] . "</option>";
                                                }
                                            }
                                        $html .= "</select></br>";
                                        $html .= "<select name='fkCategory' id='fkCategory'>";
                                            foreach($categorys as $category){
                                                if(isset($catName) and ($catName == $category['catName'])){
                                                    $html .= "<option value='" . $category['idCategory'] . "' selected>" . $category['catName'] . "</option>";
                                                }
                                                else{
                                                    $html .= "<option value='" . $category['idCategory'] . "'>" . $category['catName'] . "</option>";
                                                }
                                            }
                                        $html .= "</select></br></br>";
                                        $html .= "<input type='submit' name='btn' id='btn' value='Enregistrer' class='px-4 py-2 text-center bg-blue-500 text-white md:rounded' style='margin-left: 1.5vw'>";
                                    $html .= "</form>" ;
                                    echo $html;                                    
                                }
                                else{
                                    $html =  "<form action='' method='post'>";
                                    $html .= "<label for='memFirstName'>Prénom:</label><br>";
                                    $html .= "<input name='memFirstName' pattern='^[A-Za-z_ -éèêëàáâãäåìíîïòóôõöùúûüýñ]{3,50}$' type='text' id='memFirstName' required><br>";
                                    $html .= "<label for='memLastName'>Nom:</label><br>";
                                    $html .= "<input name='memLastName'pattern='^[A-Za-z_ -éèêëàáâãäåìíîïòóôõöùúûüýñ]{3,50}$' type='text' id='memLastName' required><br>";
                                    $html .= "<label for='memDateBirth'>Date de naissance:</label><br>";
                                    $html .= "<input name='memDateBirth' pattern='^(19[0-9][0-9]|20[0-3][0-9])(-(0[13578]|1[02]))?-(0[1-9]|[12][0-9]|3[01])$|^(19[0-9][0-9]|20[0-3][0-9])-(02)-(0[1-9]|1[0-9]|2[0-8])$|^(19[0-9][0-9]|20[0-3][0-9])-(02)-29$' type='date' id='memDateBirth' required><br><br>";
                                    $html .= "<label for='memPhoneNumber'>Numéro de téléphone:</label><br>";
                                    $html .= "<input name='memPhoneNumber' pattern='^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$' type='text' id='memPhoneNumber' required><br>";
                                    $html .= "<label for='memLicencing'>Licence:</label><br>";
                                    $html .= "<input name='memLicencing' pattern='^[A-Z][0-9]{5}$' type='text' id='memLicencing'><br>";
                                    $html .= "<label for='memRanking'>Elo:</label><br>";
                                    $html .= "<input name='memRanking' pattern='^([5-9][0-9]{2}|[1-1][0-9][0-9]{2}|[2-2][0-9][0-9]{2}|[3-3][0-4][0-9]{2}|3500)$' type='number' id='memRanking'><br>";
                                    $html .= "<select name='fkTitle' id='fkTitle'>";
                                        $html .= "<option value='0' selected>--Choisissez un titre--</option>'>";
                                        foreach($titles as $title){
                                            $html .= "<option value='" . $title['idTitle'] . "'>" . $title['titName'] . "</option>";
                                        }
                                    $html .= "</select></br></br>";
                                    $html .= "<select name='fkCategory' id='fkCategory' required>";
                                        $html .= "<option value='' selected disabled>--Choisissez une catégorie--</option>'>";
                                        foreach($categorys as $category){
                                            $html .= "<option value='" . $category['idCategory'] . "'>" . $category['catName'] . "</option>";
                                        }
                                    $html .= "</select></br></br>";
                                    $html .= "<input type='submit' name='btn' id='btn' value='Ajouter' class='px-4 py-2 text-center bg-blue-500 text-white md:rounded' style='margin-left: 1.5vw'>";
                                    $html .= "</form>" ;
                                    echo $html;
                                }
                                ?>
                                 </br> 
                                </br>
                                <a href='List-Member' class='px-4 py-2 text-center bg-red-500 text-white md:rounded' style='margin-left: 1.5vw'>Retour</a>
                            </div>
                            <?php
                                if($error){
                            ?>
                                <div class="bg-red-50 border-l-8 border-red-900 mb-2">
                                    <div class="flex items-center">
                                        <div class="p-2">
                                            <div class="flex items-center">
                                                <div class="ml-2">
                                                    <svg class="h-8 w-8 text-red-900 mr-2 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                                <p class="px-6 py-4 text-red-900 font-semibold text-md">le nom ou/et le mot de passe sont incorrect ou vide</p>
                                            </div>
                                            <div class="px-16 mb-4">
                                            <?php
                                                foreach($AllErrors as $detailError){
                                                    echo "<li class='text-md font-bold text-red-500 text-sm'>$detailError</li>";
                                                }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            <?php 
                                }
                            ?> 
                        </div>
                    </div>
                </main>
                <!-- <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022 © Dorian Capelli</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer> -->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../js/chart-area-demo.js"></script>
        <script src="../js/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
