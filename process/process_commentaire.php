

<?php

require_once '../connect/connectDB.php';
session_start();


// INSERER ICI validation du formulaire




$sql = "INSERT INTO commentaire (id_photo, sms, id_user)
 VALUES (:id_photo, :sms, :id_user )";

try {
    $stmt = $pdo->prepare($sql);
    $users = $stmt->execute([
        ':id_photo' => $_POST["id"],
        ':sms' => $_POST["sms"],
        ':id_user' => $_SESSION["pseudo"]['id']
    ]); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat




} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


header("Location: ../front/commentaire/commentaire.php?id=".$_POST["id"]);
exit;

?>