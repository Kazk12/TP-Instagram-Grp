<?php 
require_once '../../connect/connectDB.php';
session_start();

$img = $_GET['id']; // ID de l'image

// Récupérer les commentaires associés à la photo
$sqlCommentaires = "SELECT commentaire.sms, user.pseudo 
                    FROM commentaire 
                    INNER JOIN user ON user.id = commentaire.id_user 
                    WHERE commentaire.id_photo = :img";

try {
    $stmt = $pdo->prepare($sqlCommentaires);
    $stmt->execute([":img" => $img]);
    $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$commentaires) {
        $commentaires = []; // Pas de commentaires
    }
} catch (PDOException $error) {
    echo "Erreur lors de la requête des commentaires : " . $error->getMessage();
    die();
}

// Récupérer les informations de la photo
$sqlPhoto = "SELECT url_photo 
             FROM photo 
             WHERE id = :img";

try {
    $stmt = $pdo->prepare($sqlPhoto);
    $stmt->execute([":img" => $img]);
    $photos = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$photos) {
        echo "Photo introuvable.";
        die();
    }
} catch (PDOException $error) {
    echo "Erreur lors de la requête de la photo : " . $error->getMessage();
    die();
}

// Récupérer le pseudo de l'utilisateur associé à la photo
$sqlUser = "SELECT user.pseudo 
            FROM photo 
            INNER JOIN user ON user.id = photo.id_user 
            WHERE photo.id = :img";

try {
    $stmt = $pdo->prepare($sqlUser);
    $stmt->execute([":img" => $img]);
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$users) {
        echo "Utilisateur introuvable.";
        die();
    }
} catch (PDOException $error) {
    echo "Erreur lors de la requête de l'utilisateur : " . $error->getMessage();
    die();
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aura.</title>
    <link rel="stylesheet" href="../../assets/css/output.css">
</head>
<body class="bg-black">
<header>
    <h1 class="font-logo text-3xl font-bold pl-6 pt-4 mb-4 lg:text-5xl bg-gradient-to-r from-blue-400 via-purple-600 to-pink-500 text-transparent bg-clip-text">
        Aura.
    </h1>
</header>

<main>
    <section>
        <!-- Photo et utilisateur -->
        <article class="flex flex-col gap-3">
            <div class="flex items-center justify-between px-3">
                <div class="flex items-center gap-2">
                    <img src="../../GTzblVSWUAAIMp-.jpg" alt="Photo de profil" class="w-10 rounded-full">
                    <p class="text-white font-sans font-medium text-sm"><?= htmlspecialchars($users['pseudo']) ?></p>
                </div>
                <img src="../../assets/icons/doubler.png" alt="Menu" class="w-4">
            </div>
            <img src="../<?= htmlspecialchars($photos['url_photo']) ?>" alt="Photo associée" 
                 class="w-full h-auto sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 mx-auto">
        </article>

        <!-- Commentaires -->
        <article class="flex flex-col gap-2 xl:justify-center px-4 md:px-6 lg:px-8">
            <?php foreach ($commentaires as $commentaire): ?>
                <div class="flex items-start p-2 gap-3 sm:p-3 md:p-4">
                    <img src="../../GTzblVSWUAAIMp-.jpg" alt="Photo de profil" class="w-10 rounded-full">
                    <p class="text-white font-sans font-medium text-sm sm:text-base md:text-lg">
                        <span class="block font-medium"><?= htmlspecialchars($commentaire['pseudo']) ?></span>
                        <span class="font-light text-red-400"><?= htmlspecialchars($commentaire['sms']) ?></span>
                    </p>
                </div>
            <?php endforeach; ?>
        </article>

        <!-- Formulaire d'ajout de commentaire -->
        <form action="../../process/process_commentaire.php" method="post" class="flex items-center justify-between px-3">
            <input type="text" name="sms" id="sms" placeholder="Ajoutez un commentaire" class="bg-black text-white">
            <input type="hidden" name="id" id="id" value="<?= htmlspecialchars($img) ?>">
            <button type="submit">
                <img src="../../assets/icons/ajouter-un-bouton.png" alt="Ajouter un commentaire" class="w-4">
            </button>
        </form>
    </section>



    <footer class="bg-black py-2 fixed bottom-0 left-0 w-full z-10 md:hidden">
    <nav class="flex justify-evenly items-center px-4">
        <!-- Icône de Test -->
         <a href="../accueil/accueil.php">
         <img src="../../assets/icons/Test.png" alt="test icon" class="w-10 h-10 object-contain">

         </a>

        <!-- Icône Loupe (recherche) -->
        <img src="../../assets/icons/Loupe_1.png" alt="search icon" class="w-10 h-10 object-contain">

        <!-- Icône Ajouter (post) -->
        <img src="../../assets/icons/ajouter-un-bouton.png" alt="add button" class="w-12 h-12 object-contain">

        <!-- Photo de l'utilisateur (profil) avec un lien -->
        <a href="../profil/profil.php">
            <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo de profil" class="w-10 h-10 rounded-full object-cover">
        </a>
    </nav>
</footer>


</main>
</body>
</html>
