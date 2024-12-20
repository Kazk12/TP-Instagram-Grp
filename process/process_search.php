<?php 

require_once '../connect/connectDB.php';
session_start();



$NomCherche = $_POST["recherche"];




try {
    // Vérifier si le pseudo existe
    $stmt = $pdo->prepare('SELECT id FROM user WHERE pseudo = :pseudo');
    $stmt->execute([':pseudo' => $NomCherche]);

    $idUser = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    echo "Erreur lors de l'insertion : " . $e->getMessage();
}

header("Location: ../front/profil/profilOther.php?id=$idUser[id]");
exit;

?>