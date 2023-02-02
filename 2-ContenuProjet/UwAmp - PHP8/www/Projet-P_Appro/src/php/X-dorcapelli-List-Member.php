<?php
///Auteur      : Dorian Capelli 
///Date        : 01.02.2023
///Description : Page of List

    session_start();
    require "X-dorcapelli-dbManage.php";
    $database = new dbManage();


    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
        $user = $_SESSION['user'];
    }

    $allMembers = $database->getAllMembers();
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
                <!-- <a href="homepage.php" class="active block md:inline-block text-black-900 hover:text-black-500 px-3 py-3 border-b-2 border-black-900 md:border-none">Accueil</a>
                <a href="book.php" class="block md:inline-block text-black-900 hover:text-black-500 px-3 py-3 border-b-2 border-black-900 md:border-none">Ouvrage</a> -->
                <?php
                    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
                        echo "<a class='block md:inline-block text-black-900 hover:text-blacks-500 px-3 py-3 border-b-2 border-black-900 md:border-none'>$user</a>";
                    }
                ?>
            </div>
            <?php
                if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
                    echo "<a href='X-dorcapelli-login' class='toggle hidden md:flex w-full md:w-auto px-4 py-2 text-right bg-gray-900 hover:bg-white-500 text-white md:rounded'>Déconnexion</a>";
                }
            ?>
        </nav>
        <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-200 text-gray-800">
            <tr class="text-left border-b-2 border-gray-400">
                <th style="width: 300px ; padding-left: 25px">Prénom</th>
                <th>Nom</th>
                <th>Rang</th>
                <th>Catégorie</th>
            </tr>
            <tr>
            <?php
                foreach($allMembers as $member){
            		$idMember = $member['idMember'];
            		$memLastName = $member['memLastName'];
            		$memFirstName = $member['memFirstName'];
                    $memRanking = $member['memRanking'];
            		$catName = $member['catName'];

            		echo "<tr>";
            		echo "<td class='px-7 py-3'>$memFirstName</td>";
                    echo "<td>$memLastName</td>";
                    echo "<td>$memRanking</td>";
                    echo "<td>$catName</td>";
                    //echo "<td><a href='X-dorcapelli-detail'><img src='../../resources/images/icons8-zoomer-24.png' alt='Loupe'></a></td>";
                    echo "<form action='X-dorcapelli-detail' method='post'><button type='submit' name='idmember' value=$idMember class='btn-link'><img src='../../resources/images/icons8-zoomer-24.png' alt='Loupe'></button></form>";
                    echo "<td><a href='X-dorcapelli-modify'><img src='../../resources/images/icons8-crayon-24.png' alt='Crayon'></a></td>";
                    echo "<td><a href='X-dorcapelli-modify'><img src='../../resources/images/icons8-poubelle-24.png' alt='poubelle'></a></td>";
            	}
            ?> 
            </tr> 
        </table>
        <footer>
            <p>© Dorian Capelli</p>
        </footer>
        <script src="../js/script.js"></script>
    </body>