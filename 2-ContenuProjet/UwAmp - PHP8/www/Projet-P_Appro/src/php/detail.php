<?php
///ETML
///Author      : Dorian Capelli 
///Date        : 03.02.2023
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
    $idMember = $_GET['idMember'];
    
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


 ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../../resources/images/chess-pawn.png" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/style.css"/>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"/>
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
    </head>
    <body>
        <nav class="flex flex-wrap items-center justify-between p-5 bg-gray-200">      
            <div class="toggle hidden md:flex w-full md:w-auto text-right text-bold mt-5 md:mt-0 border-t-2 border-blue-900 md:border-none">        
                <a href="List-Member" class="active block md:inline-block text-black-900 hover:text-black-500 px-3 py-3 border-b-2 border-black-900 md:border-none">Accueil</a>
                <?php
                    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true){
                        echo "<a class='block md:inline-block text-black-900 hover:text-blacks-500 px-3 py-3 border-b-2 border-black-900 md:border-none'>$user</a>";
                    }
                ?>
            </div>
            <?php
                if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true){
                    echo "<a href='login' class='toggle hidden md:flex w-full md:w-auto px-4 py-2 text-right bg-gray-900 hover:bg-white-500 text-white md:rounded'>Déconnexion</a>";
                }
            ?>
        </nav>
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
                $html =  "<form action=''>";
                $html .= "<label>Prénom:</label><br>";
                $html .= "<input type='text' id='memFirstName' value='$memFirstName'><br>";
                $html .= "<label>Nom:</label><br>";
                $html .= "<input type='text' id='memLastName' value='$memLastName'><br>";
                $html .= "<label>Date de naissance:</label><br>";
                $html .= "<input type='date' id='memDateBirth' value='$memDateBirth'><br>";
                $html .= "<label>Numéro de téléphone:</label><br>";
                $html .= "<input type='text' id='memPhoneNumber' value='$memPhoneNumber'><br>";
                $html .= "<label>Licence:</label><br>";
                $html .= "<input type='text' id='memLicencing' value='$memLicencing'><br>";
                $html .= "<label>Elo:</label><br>";
                $html .= "<input type='num' id='memRanking' value='$memRanking'><br>";
                $html .= "<input type='submit' value='Submit'>";
                $html .= "</form>" ;
                echo $html;
            }
            ?> 
        <footer>
            <p>© Dorian Capelli</p>
        </footer>
    </body>