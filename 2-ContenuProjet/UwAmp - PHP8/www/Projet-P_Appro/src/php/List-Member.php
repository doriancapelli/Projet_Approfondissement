<?php
///ETML
///Author      : Dorian Capelli 
///Date        : 01.02.2023
///Description : Page of List

    session_start();
    require "dbManage.php";
    $database = new dbManage();

    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
        $user = $_SESSION['userName'];
    }
    else{
        header('Location: login');
        die();
    }

    #Get All Member of Club
    $allMembers = $database->getAllMembers();
    $titles = $database->getAllTitle();
    $categorys = $database->getAllCategory();


    #Variable that determines an action
    $detail = 1;
    $modify = 2;
    $create = 3;

    if (isset($_GET['btn'])) {
        
        $memFirstName = $_GET['memFirstName'] ?? '';
        $memLastName = $_GET['memLastName'];
        $memDateBirth = $_GET['memDateBirth'];
        $memPhoneNumber = $_GET['memPhoneNumber'];
        $memLicencing = $_GET['memLicencing'];
        $memRanking = $_GET['memRanking'];
        $fkTitle = $_GET['fkTitle'];
        $fkCategory = $_GET['fkCategory'];

        $allMembers = $database->getMemberCriterion($memLastName, $memFirstName, $memDateBirth, $memPhoneNumber, $memLicencing, $memRanking, $fkTitle, $fkCategory);
    }
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Gestion de membre d'un club d'échec - List des Membre</title>
        <link rel="icon" href="../../resources/images/chess-pawn.png" />
        <link href="../../resources/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
                        <li><a class="dropdown-item" href="login">Déconnexion</a></li>
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
                            <?php
                                echo "<a class='nav-link' href='action?action=$create'>";
                            ?>
                                <div class="sb-nav-link-icon"></div>
                                Ajouter un membre
                            </a>
                            <a class="nav-link" href="PDF" target="_blank">
                                <div class="sb-nav-link-icon"></div>
                                Exporter en PDF
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
                        <h1 class="mt-4">Liste des membres</h1>
                        <div>
                            <form action="List-Member" method="GET">
                                <div class="multiSearch">
                                    <input type="checkbox" name="advancedSearch" value="1" checked style="display: none;">
                                    <div class="blockInput">
                                        <label for='memFirstName' class="multiSearchLabel">Prénom:</label>
                                        <input name='memFirstName' type='text' id='memFirstName' class="multiSearchInput">
                                    </div>
                                    <div class="blockInput">
                                        <label for='memLastName' class="multiSearchLabel">Nom:</label>
                                        <input name='memLastName' type='text' id='memLastName' class="multiSearchInput">
                                    </div>
                                    <div class="blockInput">
                                        <label for='memDateBirth' class="multiSearchLabel">Date de naissance:</label>
                                        <input name='memDateBirth' type='date' id='memDateBirth' class="multiSearchInput">
                                    </div>
                                    <div class="blockInput">
                                        <label for='memPhoneNumber' class="multiSearchLabel">Numéro de téléphone:</label>
                                        <input name='memPhoneNumber' type='text' id='memPhoneNumber' class="multiSearchInput">
                                    </div>
                                    <div class="blockInput">
                                        <label for='memLicencing' class="multiSearchLabel">Licence:</label>
                                        <input name='memLicencing' type='text' id='memLicencing' class="multiSearchInput">
                                    </div>
                                    <div class="blockInput">
                                        <label for='memRanking' class="multiSearchLabel">Elo:</label>
                                        <input name='memRanking' type='number' id='memRanking' class="multiSearchInput">
                                    </div>
                                    <div class="blockInput">
                                        <select name='fkTitle' id='fkTitle' class='multiSearchInput'>
                                        <option value='0' selected>--Choisissez un titre--</option>
                                        <?php
                                            foreach($titles as $title){
                                                echo "<option value='" . $title['idTitle'] . "'>" . $title['titName'] . "</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="blockInput">
                                        <select name='fkCategory' id='fkCategory' class='multiSearchInput'>
                                        <option value='0' selected>--Choisissez une catégorie--</option>
                                        <?php
                                            foreach($categorys as $category){
                                                    echo "<option value='" . $category['idCategory'] . "'>" . $category['catName'] . "</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="blockInput">
                                        <input type='submit' name='btn' id='btn' value='Rechercher' class='multiSearchInput'>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Membres du club d'échecs
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Prénom</th>
                                            <th>Nom</th>
                                            <th>Élo</th>
                                            <th>Catégorie</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Prénom</th>
                                            <th>Nom</th>
                                            <th>Élo</th>
                                            <th>Catégorie</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        #displays all club members one by one in a table
                                        foreach($allMembers as $member){
                                            $idMember = $member['idMember'];
                                            $memLastName = $member['memLastName'];
                                            $memFirstName = $member['memFirstName'];
                                            $memRanking = $member['memRanking'];
                                            $catName = $member['catName'];

                                            $html = "<tr>";
                                            $html .= "<td>$memFirstName</td>";
                                            $html .= "<td>$memLastName</td>";
                                            $html .= "<td>$memRanking</td>";
                                            $html .= "<td>$catName</td>";
                                            $html .= "<td><a href='action?idMember=$idMember&action=$detail'><img src='../../resources/images/icons8-zoomer-24.png' alt='Loupe'></a> ";
                                            $html .= "<a href='action?idMember=$idMember&action=$modify'><img src='../../resources/images/icons8-crayon-24.png' alt='Crayon'></a> ";
                                            $html .= "<a href='delete?idMember=$idMember' onclick='return confirm(\"Voulez vous vraiment supprimer ce membre ?\")'><img src='../../resources/images/icons8-poubelle-24.png' alt='poubelle')'></a></td>";
                                            $html .= "</tr>";
                                            echo $html;
                                        }
                                    ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
