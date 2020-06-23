<?php
header('Content-Type: application/json');
try {
    $pdo=new PDO('mysql:host=localhost;port=3306;dbname=api;','root','');
}catch (Exception $ex){
    $retour["success"]=false;
    $retour["message"]="Erreur de connexion a la base de donneee";
}
if(!empty($_POST["ville_depart"] && $_POST["ville_arrive"] && $_POST["heure_vol"] && $_POST["prix"]))
{
    if($_POST["prix"]<0){
        $retour["success"]=false;
        $retour["message"]="Erreur! prix incorrecte!..";
    }
    else{
        $requete=$pdo->prepare("INSERT INTO `vols`(`id`, `ville_depart`, `ville_arrive`, `heure_vol`, `prix`)
                             VALUES (null, :ville_depart, :ville_arrive, :heure_vol, :prix)");
        $requete->bindParam(':ville_depart', $_POST["ville_depart"]);
        $requete->bindParam(':ville_arrive', $_POST["ville_arrive"]);
        $requete->bindParam(':heure_vol', $_POST["heure_vol"]);
        $requete->bindParam(':prix', $_POST["prix"]);
        $requete->execute();
        $retour["success"]=true;
        $retour["message"]="Vol ajoute!...";
        $retour["result"]=1;
    }
}
else{
    $retour["success"]=false;
    $retour["message"]="Erreur! d'ajout il manque des informations";
}
echo json_encode($retour);
