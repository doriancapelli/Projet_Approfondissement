<?php
///Auteur      : Dorian Capelli 
///Date        : 02.02.2023
///Description : Page of Delete a member

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

    #retrieve the id of the member to be deleted
    $idMember = $_GET["idMember"];
    #Delete member
    $database->deleteMember($idMember);
    #Return on page of List Member
    header('Location: List-Member');
    die();
 ?>