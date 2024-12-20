<?php

require_once '../connect/connectDB.php';
session_start();



$NomCherche = htmlspecialchars(trim($_POST["recherche"]));





try {
    // Vérifier si le pseudo existe
    $stmt = $pdo->prepare("SELECT id FROM user WHERE pseudo LIKE :pseudo");
    $pseudo = '%' . $NomCherche . '%';

    $stmt->execute([':pseudo' => $pseudo]);

    $idUser = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion : " . $e->getMessage();
}

header("Location: ../front/profil/profilOther.php?id=$idUser[id]");
exit;
