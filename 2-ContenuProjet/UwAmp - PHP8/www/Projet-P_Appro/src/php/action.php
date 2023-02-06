<?php
///ETML
///Author      : Dorian Capelli 
///Date        : 06.02.2023
///Description : Page of detail, modify and create a member

    session_start();
    require "dbManage.php";
    $database = new dbManage();


    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
        $user = $_SESSION['user'];
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

    if(($action == 2) && $_POST['btn']){
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


            $database->updateMember($idMember, $memLastName, $memFirstName, $memDateBirth, $memPhoneNumber, $memLicencing, $memRanking, $fkTitle, $fkCategory);
            header("Location: action?idMember=$idMember&action=$action");

    }
    elseif(($action == 3) && $_POST['btn']){
        $action = 1;
        $memFirstName = $_POST['memFirstName'];
        $memLastName = $_POST['memLastName'];
        $memDateBirth = $_POST['memDateBirth'];
        $memPhoneNumber = $_POST['memPhoneNumber'];
        $memLicencing = $_POST['memLicencing'];
        $memRanking = $_POST['memRanking'];
        $fkTitle = $_POST['fkTitle'];
        $fkCategory = $_POST['fkCategory'];


        $idMember = $database->addMember($memLastName, $memFirstName, $memDateBirth, $memPhoneNumber, $memLicencing, $memRanking, $fkTitle, $fkCategory);
        header("Location: action?idMember=$idMember&action=$action");

    }

 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
            <a class="navbar-brand ps-3" href="index.html">Gestion des Membres d'un Club d'echecs</a>
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
                                        $html .= "<input name='memFirstName' type='text' id='memFirstName' value='$memFirstName'><br>";
                                        $html .= "<label for='memLastName'>Nom:</label><br>";
                                        $html .= "<input name='memLastName'type='text' id='memLastName' value='$memLastName'><br>";
                                        $html .= "<label for='memDateBirth'>Date de naissance:</label><br>";
                                        $html .= "<input name='memDateBirth'type='date' id='memDateBirth' value='$memDateBirth'><br>";
                                        $html .= "<label for='memPhoneNumber'>Numéro de téléphone:</label><br>";
                                        $html .= "<input name='memPhoneNumber'type='text' id='memPhoneNumber' value='$memPhoneNumber'><br>";
                                        $html .= "<label for='memLicencing'>Licence:</label><br>";
                                        $html .= "<input name='memLicencing' type='text' id='memLicencing' value='$memLicencing'><br>";
                                        $html .= "<label for='memRanking'>Elo:</label><br>";
                                        $html .= "<input name='memRanking' type='num' id='memRanking' value='$memRanking'><br>";
                                        $html .= "<select name='fkTitle' id='fkTitle'>";
                                        $html .= "<option value='' selected>--Please choose an option--</option>'>";
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
                                    var_dump($_POST);
                                }
                                else{
                                    $html =  "<form action='' method='post'>";
                                    $html .= "<label for='memFirstName'>Prénom:</label><br>";
                                    $html .= "<input name='memFirstName' type='text' id='memFirstName'><br>";
                                    $html .= "<label for='memLastName'>Nom:</label><br>";
                                    $html .= "<input name='memLastName' type='text' id='memLastName'><br>";
                                    $html .= "<label for='memDateBirth'>Date de naissance:</label><br>";
                                    $html .= "<input name='memDateBirth' type='date' id='memDateBirth'><br><br>";
                                    $html .= "<label for='memPhoneNumber'>Numéro de téléphone:</label><br>";
                                    $html .= "<input name='memPhoneNumber' type='text' id='memPhoneNumber'><br>";
                                    $html .= "<label for='memLicencing'>Licence:</label><br>";
                                    $html .= "<input name='memLicencing' type='text' id='memLicencing'><br>";
                                    $html .= "<label for='memRanking'>Elo:</label><br>";
                                    $html .= "<input name='memRanking' type='num' id='memRanking'><br>";
                                    $html .= "<select name='fkTitle' id='fkTitle'>";
                                        $html .= "<option value='' selected>--Please choose an option--</option>'>";
                                        foreach($titles as $title){
                                            $html .= "<option value='" . $title['idTitle'] . "'>" . $title['titName'] . "</option>";
                                        }
                                    $html .= "</select></br></br>";
                                    $html .= "<select name='fkCategory' id='fkCategory'>";
                                        $html .= "<option value='' selected disabled>--Please choose an option--</option>'>";
                                        foreach($categorys as $category){
                                            $html .= "<option value='" . $category['idCategory'] . "'>" . $category['catName'] . "</option>";
                                        }
                                    $html .= "</select></br></br>";
                                    $html .= "<input type='submit' name='btn' id='btn' value='Ajouter' class='px-4 py-2 text-center bg-blue-500 text-white md:rounded' style='margin-left: 1.5vw'>";
                                    $html .= "</form>" ;
                                    echo $html;
                                    var_dump($_POST);
                                }
                                ?>
                                 </br> 
                                </br>
                                <!-- <a href='List-Member' class='px-4 py-2 text-center bg-red-500 text-white md:rounded' style='margin-left: 1.5vw'>Retour</a> -->
                            </div>
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
