<?php
header('Content-Type: application/json');
try {
        $pdo=new PDO('mysql:host=localhost;port=3306;dbname=api;','root','');
}catch (Exception $ex){
    $retour["success"]=false;
    $retour["message"]="Erreur de connexion a la base de donneee";
}
if(!empty($_POST["ville_depart"]))
{
    $requete=$pdo->prepare("SELECT * FROM `vols` WHERE `ville_depart` LIKE :pays;");
    $requete->bindParam(':pays', $_POST["ville_depart"]);
    $requete->execute();
}
else{
    $requete=$pdo->prepare("select *FROM vols;");
    $vols=$requete->execute();
}
$vols=$requete->fetchAll();
$retour["success"]=true;
$retour["message"]="Connexion a la base de donneee reussie";
$retour["result"]["nombre_vol"]=count($vols);
$retour["result"]["vols"]=$vols;
echo json_encode($retour);