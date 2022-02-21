<?php
require 'isset.php';
require 'Config.php';
require 'Connect.php';
require 'DataCleaner.php';

/**
 * 1. Le dossier SQL contient l'export de ma table user.
 * 2. Trouvez comment importer cette table dans une des bases de données que vous avez créées,
 si vous le souhaitez vous pouvez en créer une nouvelle pour cet exercice.
 * 3. Assurez vous que les données soient bien présentes dans la table.
 * 4. Créez votre objet de connexion à la base de données comme nous l'avons vu
 * 5. Insérez un nouvel utilisateur dans la base de données user
 * 6. Modifiez cet utilisateur directement après avoir envoyé les données ( on imagine que vous vous êtes trompé )
 */

// TODO Votre code ici.
if(issetParam('nom','prenom','rue','code_postal','ville','pays','mail')) {
    try {
        $cleaner = new DataCleaner();
        $myConnexion = Connect::dbConnect();

        $nom = $cleaner->dataClean($_POST['nom']);
        $prenom = $cleaner->dataClean($_POST['prenom']);
        $rue = $cleaner->dataClean($_POST['rue']);
        $codePostal = $cleaner->dataClean($_POST['code_postal']);
        $ville = $cleaner->dataClean($_POST['ville']);
        $pays = $cleaner->dataClean($_POST['pays']);
        $mail = $cleaner->dataClean($_POST['mail']);

        $stmt = $myConnexion->prepare("
        INSERT INTO user (nom, prenom, rue, code_postal, ville, pays, mail)
        VALUES ('Mastia','Angel','françois boussus','59212','wignehies','France', 'angelique.mastia@gmail.com')
    ");

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':rue', $rue);
        $stmt->bindParam(':codePostal', $codePostal);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':pays', $pays);
        $stmt->bindParam(':mail', $mail);
        $result = $stmt->execute();
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
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