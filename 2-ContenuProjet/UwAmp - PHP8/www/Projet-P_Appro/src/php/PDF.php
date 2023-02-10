<?php
///ETML
///Author      : Dorian Capelli & Sylvain Philipona
///Date        : 10.02.2023
///Description : Create a PDF of List Member
session_start();
require "dbManage.php";
require('tfpdf.php');

$database = new dbManage();
$users = $database->getAllMembers();
if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
    $user = $_SESSION['userName'];
}
else{
    header('Location: login');
    die();
}

//Create the pdf and add a page 
$pdf = new tFPDF();
$pdf->AddPage();

// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

//Title
// $pdf->Cell(0, 8, "Prénom:" . "     " . "Nom:" . "       " . "Licence:" . "   " . "Élo:" . "   " . "Catégorie:" . "   " . "Titre:", 0, 1);

// Write the datas
foreach($users as $user){
    $pdf->Cell(0,8,
        $user["memFirstName"] . " " . 
        $user["memLastName"] . "   " . 
        $user["titName"] . "   " .
        $user["catName"] . "   " .
        "Élo: " . $user["memRanking"] . "   " .
        "Licence: " . $user["memLicencing"], 0, 1);

    $pdf->Cell(0, 8, "", 0, 1);
}

$pdf->Output('I', "joca.pdf", true);
?>