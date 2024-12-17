<?php
require_once '../connect/connectDB.php';
session_start();

if (!isset($_POST['pseudo']) || empty(trim($_POST['pseudo']))) {
    echo "Le pseudo est requis.";
    exit;
}

// var_dump($_POST);
// die();
$username = htmlspecialchars(trim($_POST['pseudo'])); 

try {
    // Vérifier si le pseudo existe
    $stmt = $pdo->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
    $stmt->execute([':pseudo' => $username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Ajouter un nouvel utilisateur si le pseudo n'existe pas
        $sql = "INSERT INTO user (pseudo) VALUES (:pseudo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':pseudo' => $username]);

        // Stocker l'utilisateur dans la session
        $_SESSION['pseudo'] = [
            'id' => $pdo->lastInsertId(),
            'pseudo' => $username
        ];
    } else {
        $_SESSION['pseudo'] = [
            'id' => $user['id'],
            'pseudo' => $user['pseudo']
        ];
    }

    // header("Location: ../front/Acceuil/accueil.php");
    // exit;
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion : " . $e->getMessage();
}
