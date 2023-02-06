<?php
///Auteur      : Dorian Capelli 
///Date        : 01.02.2023
///Description : Page of login

    session_start();
    require "dbManage.php";
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
            if($user){
                if(password_verify($password, $user[0]['usePassword']))
                {
                    $_SESSION['isConnected'] = true;
                    $_SESSION['user'] = $login;

                    header("Location:List-Member");
                    die();
                }
                else{
                    $error = true;
                }
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
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Gestion de membre d'un club d'échec - Connexion</title>
        <link href="../../resources/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Connexion</h3></div>
                                    <div class="card-body">
                                        <form action="login" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="userName" name="userName" type="text" placeholder="Ex: Admin" />
                                                <label for="userName">Nom utilisateur</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="usePassword" name="usePassword" type="password" placeholder="Password" />
                                                <label for="usePassword">Mot de passe</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary" name="btn" value="Connexion"/>
                                            </div>
                                        </form>
                                        </br>
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
                                                            <li class="text-md font-bold text-red-500 text-sm">Vérifier le nom</li>
                                                            <li class="text-md font-bold text-red-500 text-sm">Vérifier le mot de passe</li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        <?php }
                                        ?>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Gestion des membres d'un club d'échecs 2023 © Dorian Capelli</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
    </body>
</html>
