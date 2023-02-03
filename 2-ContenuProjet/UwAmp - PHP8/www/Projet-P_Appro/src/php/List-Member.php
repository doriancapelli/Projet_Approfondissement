<?php
///ETML
///Author      : Dorian Capelli 
///Date        : 01.02.2023
///Description : Page of List

    session_start();
    require "dbManage.php";
    $database = new dbManage();


    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
        $user = $_SESSION['user'];
    }

    #Get All Member of Club
    $allMembers = $database->getAllMembers();

    #Variable that determines an action
    $detail = 1;
    $modify = 2;
    $create = 3;
 ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../../resources/images/chess-pawn.png" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/style.css"/>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"/>
        <title>Gestion de membre d'un club d'échec - List des Membre</title>
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
        </br>
        <?php
            echo("<div style='display:flex;'>");
                echo "<a href='detail?action=$create' class='md:block px-4 py-2 text-center bg-blue-500 text-white md:rounded' style='margin-left: 8.4vw'>Ajouter un membre</a>";
                echo "<a href='List-Member' class='md:block px-4 py-2 text-center bg-green-500 text-white md:rounded' style='margin-left: 66vw'>Exporter en PDF</a>";
            echo("</div>");
        ?>
        <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-200 text-gray-800">
            <tr class="text-left border-b-2 border-gray-400">
                <th style="width: 300px ; padding-left: 25px">Prénom</th>
                <th>Nom</th>
                <th>Elo</th>
                <th>Catégorie</th>
            </tr>
            <tr>
            <?php
                #displays all club members one by one in a table
                foreach($allMembers as $member){
            		$idMember = $member['idMember'];
            		$memLastName = $member['memLastName'];
            		$memFirstName = $member['memFirstName'];
                    $memRanking = $member['memRanking'];
            		$catName = $member['catName'];

            		$html = "<tr>";
            		$html .= "<td class='px-7 py-3'>$memFirstName</td>";
                    $html .= "<td>$memLastName</td>";
                    $html .= "<td>$memRanking</td>";
                    $html .= "<td>$catName</td>";
                    $html .= "<td><a href='detail?idMember=$idMember&action=$detail'><img src='../../resources/images/icons8-zoomer-24.png' alt='Loupe'></a></td>";
                    $html .= "<td><a href='detail?idMember=$idMember&action=$modify'><img src='../../resources/images/icons8-crayon-24.png' alt='Crayon'></a></td>";
                    $html .= "<td><a href='delete?idMember=$idMember'><img src='../../resources/images/icons8-poubelle-24.png' alt='poubelle'></a></td>";
                    echo $html;
            	}
            ?> 
            </tr> 
        </table>
        <footer>
            <p>© Dorian Capelli</p>
        </footer>
    </body>