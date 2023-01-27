<?php
///Auteur      : Dorian Capelli 
///Date        : 16.06.2022
///Description : Page de formulaire de Caisse

    session_start();
    require "dbManage.php";
    $database = new dbManage();

    $stock = $database->getAllStock();
    $commande = array('1' => '','2' => '','3' => '','4' => '','5' => '');

    if (isset($_POST)) {
    }
 ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Wesh c'est trop bien - Caisse</title>
        <link rel="icon" href="https://i.pinimg.com/736x/d9/20/52/d920527f39800943d9fc5f5264acc866.jpg" />
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" />
    </head>
    <body class="flex h-screen bg-gray-200">
        <div>
            <header>
            </header>
            <form action="fromCaisse" method="post">
                <?php
					foreach ($stock as $key => $value) {
                		$id = $stock[$key]["idStock"];
            			echo "<img src='../../resources/images/". $id .".jpg' width='100' height='100'/>";
            			echo $stock[$key]["stoNom"], "<br>";
            			echo $stock[$key]["stoPrix"], "<br>";
            			echo $stock[$key]["stoQuantite"], "<br>";
            			echo "<button class='px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue bg-gray-900 active:bg-blue-600 hover:bg-gray-700'><a href='formCaisse' name=". $id ."> Ajouter</button><br><br>";
                	}
                ?>
            	<button class="px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue bg-gray-900 active:bg-blue-600 hover:bg-gray-700"><a href="formCaisse"> Quitance</button><br>
            	<div></div>
            </form>
        </div>
    </body>
</html>