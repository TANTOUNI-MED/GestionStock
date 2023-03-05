<?php 
require('commandeClass.php');
require('clientClass.php');
require('produitClass.php');

$com=new commande();
$cli=new client();
$prod=new produit();

if(isset($_GET['num'])){
	$idcm=$_GET['num'];
 $reponseCom=$com->UnComProd($idcm);

$lineCom=$reponseCom->fetch();
 $qauntite_com=$lineCom['quan_prod'];
 $datee=$lineCom['date'];
$cl=$lineCom['id_cli'];
$pr=$lineCom['ref_prod'];

$reponseCli=$cli->rechercher($cl);
$reponseProd=$prod->rechercher($pr);
$lineCli=$reponseCli->fetch();
$lineProd=$reponseProd->fetch();

$clientn=$lineCli['nom_cli'];
$clienta=$lineCli['adresse_cli'];
$cliente=$lineCli['email_cli'];
$clientt=$lineCli['tele_cli'];

$produitsl=$lineProd['libelle'];
$produitsp=$lineProd['prix_vent'];
require('fpdf.php');

//Création d'un nouveau doc pdf (Portrait, en mm , taille A5)
$pdf = new FPDF('P', 'mm', 'A5');

//Ajouter une nouvelle page
$pdf->AddPage();

// entete


// Saut de ligne
$pdf->Ln(18);


// Police Arial gras 16
$pdf->SetFont('Arial', 'B', 16);

// Titre
$pdf->Cell(0, 10, 'facture de commande', 'TB', 1, 'C');
$pdf->Cell(0, 10, 'Numero :'.$idcm, 0, 1, 'C');

// Saut de ligne
$pdf->Ln(5);

// Début en police Arial normale taille 10

$pdf->SetFont('Arial', '', 10);
$h = 7;
$retrait = "      ";

/*$pdf->Write($h, "Je soussigné, Directeur de l'établissement CLEVER SCHOOL 2 PRIVEE EL ATTAOUIA Certifie que : \n");*/

$pdf->Write($h, $retrait . "Le client  : ");

//Ecriture en Gras-Italique-Souligné(U)
$pdf->SetFont('', 'BIU');
$pdf->Write($h, $clientn . "\n");

//Ecriture normal
$pdf->SetFont('', '');

$pdf->Write($h, $retrait . "adresse: " . $clienta .  "\n");

$pdf->Write($h, $retrait . "email : " . $cliente . " \n");

$pdf->Write($h, $retrait . "N de telephone : " . $clientt .  " \n");

$pdf->Write($h, $retrait . "a commende un :  " . $produitsl. " \n");

$pdf->Write($h, $retrait . "avec un quantite de  :  " . $qauntite_com . "  \n");

$pdf->Write($h, $retrait . "en  :  " . $datee . " \n");

$pdf->Write($h, $retrait . "prix de produit :  " . $produitsp . " DH \n");
$pdf->Cell(0, 5, "prix total de commande :  ".$produitsp*$qauntite_com. " DH", 'TB', 1, 'C');

/*$pdf->Write($h, "La présente attestation est délivrée à l'intéressé Pour servir et valoir ce que de droit. \n");*/
$pdf->Write($h, $retrait . "". "\n");

$pdf->Write($h, $retrait . "". "\n");
// Décalage de 20 mm à droite
$pdf->Cell(20);
$pdf->Cell(80, 8, "Signature", 1, 1, 'C');

// Décalage de 20 mm à droite
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C'); // LR Left-Right
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LR', 1, 'C');
$pdf->Cell(20);
$pdf->Cell(80, 5, ' ', 'LRB', 1, 'C'); // LRB : Left-Right-Bottom (Bas)
$pdf->Write($h, $retrait . "". "\n");
$pdf->Write($h, $retrait . "". "\n");
$pdf->Cell(0, 5, 'Fait à Safi le  :' . date('d/m/Y'), 0, 1, 'C');
//Afficher le pdf
$pdf->Output('', '', true);
}

?>