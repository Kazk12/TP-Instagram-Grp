


<?php



require_once '../connect/connectDB.php';


session_start();

// var_dump($_SESSION);
// var_dump($_POST);
// die();




try {
    // Si aucun like n'existe, on insère le like
    $insertSql = "INSERT INTO message  (id_user, content, id_receveur) VALUES (:id_user , :content , :id_receveur)";
    $stmt = $pdo->prepare($insertSql);
    $stmt->execute([
        ':id_user' => $_SESSION['pseudo']['id'],
        ':content' => $_POST['content'],
        ':id_receveur' => $_POST['id_receveur']
    ]);
    
    echo "Message envoyer";
}

 catch (PDOException $error) {
echo "Erreur lors de la requête : " . $error->getMessage();
}



header("Location: ../front/profil/profilOther.php?id=". $_POST['id_receveur']);
exit;