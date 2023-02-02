<?php
///Auteur      : Dorian Capelli 
///Date        : 02.02.2023
///Description : Page of Delete a member

    require "X-dorcapelli-dbManage.php";
    $database = new dbManage();

    #retrieve the id of the member to be deleted
    $idMember = $_GET["idMember"];
    #Delete member
    $database->deleteMember($idMember);
    #Return on page of List Member
    header('Location: X-dorcapelli-List-Member');
 ?>