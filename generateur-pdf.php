<?php
require __DIR__ ."/vendor/autoload.php";
use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$type = $_POST['type'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$code = $_POST['code'];
$superficie_1 = $_POST['superficie_1'];
$date = $_POST['date'];
$type_2 = $_POST['type_2'];
$superficie_2 = $_POST['superficie_2'];
$mt_lot = $_POST['mt_lot'];
$mt_verse = $_POST['mt_versé'];
$rste_payer = $_POST['rste_payer'];
$p_payement = $_POST['p_payement'];
$mtnt_parMois = $_POST['mtnt_parMois'];
$date_pVersement = $_POST['date_pVersement'];
$date_limitePaiement = $_POST['date_limitePaiement'];
$valeurs = [$nom, $prenom, $type, $telephone, $email, $code, $superficie_1, $date, $type_2, $superficie_2, $mt_lot, $mt_verse, $rste_payer, $p_payement, $mtnt_parMois, $date_pVersement, $date_limitePaiement];
$variables = ["{{nom}}", "{{prenom}}", "{{type}}", "{{telephone}}", "{{email}}", "{{code}}", "{{superficie_1}}", "{{date}}", "{{type_2}}", "{{superficie_2}}", "{{mt_lot}}", "{{mt_verse}}", "{{rste_payer}}", "{{p_payement}}", "{{mtnt_parMois}}", "{{date_pVersement}}", "{{date_limitePaiement}}"];

for($i=0;$i<count($valeurs);$i++){
    if(empty($valeurs[$i])){
        $valeurs[$i] = "NEANT";
    }
}

// Créez une instance de Dompdf

$option = new Options;
$option->setChroot(__DIR__);
$option->setIsRemoteEnabled(true);
$option->set("max-size",2);
$dompdf = new Dompdf();
$dompdf = new Dompdf($option);
// Commencez à générer le contenu HTML du PDF

$html = file_get_contents("Template.html");

$html =str_replace($variables,$valeurs,$html);
// Récupérez le contenu généré

// Chargez le contenu HTML dans DOMPDF

$dompdf->loadHtml($html);
// Réglez le format et l'orientation du document PDF


$dompdf->setPaper('A4', 'portrait');
// Générez le PDF


$dompdf->render();
$dompdf->addInfo("Title","BEREKIA-ECHEANCIER");
$dompdf->stream("BEREKIA-".$nom.".pdf",["Attachment" => 0]);




};
?>