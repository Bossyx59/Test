<?php

//définition des variables de connection
$dbnom = "exosql"; //nom de la base de données
$utilisateur = "root"; //login de phpMyadmin
$mot_passe = ""; //mot de passe de phpMyadmin
$dsn = "mysql:host=localhost;dbname=$dbnom"; //information pour se connecter (data source name)
//connection à la base de données

try {
    $bdd = new PDO($dsn, $utilisateur, $mot_passe); //instance de la classe objet connection
} catch (PDOException $e) {
    $msg = "erreur dans : " . $e->getFile() . 'ligne:' . $e->getLine() . ":" . $e->getMessage(); //définition de l'erreur
    die($msg); //on stoppe l'execution en affichant le message d'erreur
}

//-------------------------------------------------------------------------------------------------------------

for ($i = 1; $i <= 1000; $i++) {
    $bdd->query("INSERT INTO client (id,nom)"
            . "VALUE ($i , 'Client $i')");
    $tab = $bdd->query("SELECT id FROM client")->fetchAll();
        for ($j = 0; $j < 500; $j++) {
            $bdd->query("INSERT INTO operation (client_id , type_operation , montant_TVA)"
                    . "VALUE ($i , 'Retrait', FLOOR(RAND() * 500))");
            $bdd->query("INSERT INTO operation (client_id , type_operation , montant_TVA)"
                    . "VALUE ($i , 'Versement' , FLOOR(RAND() * 5000))");
        }  
}

echo "tache effectuée";
?>



