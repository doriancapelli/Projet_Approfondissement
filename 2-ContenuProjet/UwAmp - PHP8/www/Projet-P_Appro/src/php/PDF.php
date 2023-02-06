<?php
  
require('fpdf/fpdf.php');
require "dbManage.php";
$database = new dbManage();

// if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
//     $user = $_SESSION['user'];
// }
// else{
//     header('Location: login');
//     die();
// }

  
class PDF extends FPDF {
  
    // Page header
    function Header() {
          
        // Add logo to page
        // $this->Image('../../resources/images/icons8-crayon-24.png',10,8,33);
          
        // Set font family to Arial bold 
        $this->SetFont('Arial');
          
        // Move to the right
        // $this->Cell(80);
          
        // Header
        // $this->Cell(50,10,'Headéing',1,0,'C');
        $this->Cell(0, 8, "Nom:" . " " . "Prénom:" . " " . "Date de naissance:" . " " . "Numéro de téléphone:" . " " . "Licence:" . " " . "Élo:" . " " . "Catégorie:" . " " . "Titre:", 0, 1);

        // Line break
        $this->Ln(5);
    }
  
    // Page footer
    function Footer() {
          
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
          
        // Arial italic 8
        $this->SetFont('Arial','I',8);
          
        // Page number
        $this->Cell(0,10,'Page ' . 
            $this->PageNo() . '/{nb}',0,0,'C');
    }
}

$users = $database->getAllMembers();
  
// Instantiation of FPDF class
$pdf = new PDF();
  
// Define alias for number of pages
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial');
  
foreach($users as $user){
    $pdf->Cell(0, 8, 
        $user["memLastName"] . " " . 
        $user["memFirstName"] . " " . 
        $user["memDateBirth"] . " " . 
        $user["memPhoneNumber"] . " " . 
        $user["memLicencing"] . " " . 
        $user["memRanking"] . " " . 
        $user["catName"] . " " . 
        $user["titName"], 0, 1);
}

$pdf->Output("", "test.pdf", TRUE);
  
?>