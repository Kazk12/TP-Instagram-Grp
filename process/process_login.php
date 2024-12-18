<?php
require_once '../connect/connectDB.php';
session_start();

if (!isset($_POST['pseudo']) || empty(trim($_POST['pseudo'])) || !isset($_POST['mdp']) || empty(trim($_POST['mdp']))) {
    echo "Le pseudo et le mot de passe sont requis.";
    exit;
}

$username = htmlspecialchars(trim($_POST['pseudo']));
$password = trim($_POST['mdp']);

try {
    // Vérifier si le pseudo existe
    $stmt = $pdo->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
    $stmt->execute([':pseudo' => $username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mdp'])) {
        // Connexion réussie
        $_SESSION['pseudo'] = [
            'id' => $user['id'],
            'pseudo' => $user['pseudo']
        ];
    } elseif (!$user) {
        // Ajouter un nouvel utilisateur si le pseudo n'existe pas
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (pseudo, mdp) VALUES (:pseudo, :mdp)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':pseudo' => $username, ':mdp' => $hash]);

        $_SESSION['pseudo'] = [
            'id' => $pdo->lastInsertId(),
            'pseudo' => $username
        ];
    } else {
        $_SESSION["mdp-incorect"] = "Votre mot de passe ou votre identifiant est incorect";
        header("Location: ../index.php");
        exit;
    }

   
    // var_dump($_SESSION);
    // die();
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion : " . $e->getMessage();
}

header("Location: http://localhost/TP-Instagram-Gp/TP-Instagram-Grp/front/accueil/accueil.php");
exit;