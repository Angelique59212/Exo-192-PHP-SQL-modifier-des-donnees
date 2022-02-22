<?php
require 'Config.php';
require 'Connect.php';

    try {
        $myConnexion = Connect::dbConnect();

        $nom = 'Mastia';
        $prenom = 'Angel';
        $rue = 'francois boussus';
        $numero = 35;
        $codePostal = 59212;
        $ville = 'wignehies';
        $pays = 'france';
        $mail = 'angel@gmail.com';

        $stmt = $myConnexion->prepare("
            INSERT INTO user(nom, prenom, rue, numero, code_postal, ville, pays, mail)
            VALUES (:nom,:prenom,:rue,:numero,:code_postal,:ville,:pays, :mail)
    ");

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':rue', $rue);
        $stmt->bindParam(':numero',$numero,PDO::PARAM_INT);
        $stmt->bindParam(':code_postal', $codePostal,PDO::PARAM_INT);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':pays', $pays);
        $stmt->bindParam(':mail', $mail);

        $id = 4;
        $nom = 'dehainaut';
        $stmt = $myConnexion->prepare("
            UPDATE user SET nom = :nom WHERE id = :id;
        ");
        $stmt->bindParam(":nom",$nom);
        $stmt->bindParam(":id",$id);
        if ($stmt->execute()) {
            echo "utilisateur ajouté";
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }





/**
 * Théorie
 * --------
 * Pour obtenir l'ID du dernier élément inséré en base de données, vous pouvez utiliser la méthode: $bdd->lastInsertId()
 *
 * $result = $bdd->execute();
 * if($result) {
 *     $id = $bdd->lastInsertId();
 * }
 */