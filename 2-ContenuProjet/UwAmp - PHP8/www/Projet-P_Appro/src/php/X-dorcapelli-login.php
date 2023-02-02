<?php
///Auteur      : Dorian Capelli 
///Date        : 01.02.2023
///Description : Page of login

    session_start();
    require "X-dorcapelli-dbManage.php";
    $database = new dbManage();
    $error = false;

    if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
    	session_destroy();
    	header("Refresh:0");
    }
    else{
    	if(isset($_POST['btn']))
    	{
        	$login = $_POST['userName'];
        	$password = $_POST['usePassword'];

            $user = $database->connectuser($login);
            
            //Verify the password
            if(password_verify($password, $user[0]['usePassword']))
            {
                $_SESSION['isConnected'] = true;
                $_SESSION['user'] = $login;

                header("Location:X-dorcapelli-List-Member");
                die();
            }
            else{
                $error = true;
            }
    	}	
    }
 ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestion de membre d'un club d'échec - Connexion</title>
        <link rel="icon" href="../../resources/images/chess-pawn.png" />
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" />
    </head>
    <body class="flex h-screen bg-gray-200">   
        <div class="max-w-sm w-full m-auto bg-gray-400 rounded p-5">   
            <form action="X-dorcapelli-login.php" method="post">
                <div>
                    <label class="block mb-2 text-gray-900" for="userName">Nom utilisateur</label>
                    <input class="w-full p-2 mb-6 text-gray-900 border-b-2 border-indigo-500 outline-none focus:bg-gray-300" type="text" name="userName">
                </div>
                <div>
                    <label class="block mb-2 text-gray-900" for="usePassword">Mot de passe</label>
                    <input class="w-full p-2 mb-6 text-gray-900 border-b-2 border-indigo-500 outline-none focus:bg-gray-300" type="password" name="usePassword">
                </div>
                <div>
                    <input class="w-full bg-gray-900 hover:bg-gray-500 text-white hover:text-gray-900 font-bold py-2 px-4 mb-6 rounded" value="Connexion" type="submit" name="btn">
                </div>       
                </form>
                    <?php
                        if (isset($_GET["page"])){
                            echo '<input type="hidden" name="page" value="'.$_GET["page"].'">';
                        }
                    ?>  
                <?php
                 if($error){ 
                    echo '<div class="bg-red-50 border-l-8 border-red-900 mb-2">
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
                                     <li class="text-md font-bold text-red-500 text-sm">Vérifier le nom</li>
                                     <li class="text-md font-bold text-red-500 text-sm">Vérifier le mot de passe</li>
                                 </div>
                             </div>
                         </div>
                     </div>';    
                 }
                 ?>  
            </form>
        </div>
    </body>  
</html>