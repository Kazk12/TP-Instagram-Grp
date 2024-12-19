<?php
require_once '../../connect/connectDB.php';

session_start();



$sql = "SELECT photo.id , id_user, url_photo, texteimage, pseudo FROM photo INNER JOIN user WHERE user.id = photo.id_user";

try {
    $query = $pdo->prepare($sql);
    $query->execute();
$photos = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
   
echo "Erreur lors de la requete : " . $error->getMessage();
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
<body class="bg-black ">



<header>
    <h1 class="font-logo bg-gradient-to-r from-blue-400 via-purple-600 to-pink-500 text-transparent bg-clip-text text-3xl font-bold pl-6 pt-4 mb-4 lg:text-5xl lg:mb-8">Aura.</h1>
</header>

<section>
<nav class="hidden lg:flex lg:justify-center lg:gap-16 lg:items-center lg:px-4 lg:fixed   ">
        <!-- Icône de Test -->
        <img src="../../assets/icons/Test.png" alt="test icon" class="lg:w-6 lg:h-10 lg:object-contain">

        <!-- Icône Loupe (recherche) -->
        <img src="../../assets/icons/Loupe_1.png" alt="search icon" class="lg:w-6  lg:h-10 lg:object-contain">

        <!-- Icône Ajouter (post) -->
        <img src="../../assets/icons/ajouter-un-bouton.png" alt="add button" class="lg:w-6  lg:h-12 lg:object-contain">

        <!-- Photo de l'utilisateur (profil) avec un lien -->
        <a href="../profil/profil.php">
            <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo de profil" class="lg:w-10  lg:h-10  lg:rounded-full  lg:object-cover">
        </a>
    </nav>
</section>

<main class="pb-16 "> <!-- Ajout de padding-bottom pour éviter que le footer ne cache le contenu -->
    <p class="text-white">

    </p>
    <section class="">
        <?php 

        foreach ($photos as $photo ) {
        
        
        
        ?>
        <article class="flex flex-col gap-3 lg:gap-8 xl:px-96 ">
            <div class="flex items-center justify-between px-3">
                <div class="flex items-center gap-2">
                    <a href="../profil/profilOther.php?id=<?= $photo["id_user"] ?>">
                    <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo de singe" class="w-10 rounded-full">

                    </a>
                    <p class="text-white font-sans font-medium text-sm"><?= $photo["pseudo"] ?></p>
                </div>
                <img src="../../assets/icons/doubler.png" alt="menu petits points" class="w-4">
            </div>
            <div class="flex justify-center lg:h-[600px]">
                <img src="../<?= $photo["url_photo"] ?>" alt="photo d'utilisateur" height="100%" width="auto"> 
            </div>
            <div class="flex w-6 gap-2 ml-4">
                <img src="../../assets/icons/contour-en-forme-de-coeur.png" alt="bouton j'aime">
                <img src="../../assets/icons/commentaire.png" alt="bouton commentaire">
            </div>
            <p class="text-white px-3">Liked by 6 users</p>
            <p class="text-white px-3"><?= $photo["pseudo"] ?> : <?= $photo["texteimage"] ?></p>
            <a href="../commentaire/commentaire.php?id=<?= $photo["id"]?>" class="text-white px-3">View all comments</a>

            <form action="" method="post" class="flex items-center justify-between px-3">

                <input type="text" name="commentaire" id="commentaire" placeholder="Add a comment..." class="bg-black text-white">
                <button type="submit"><img src="../../assets/icons/ajouter-un-bouton.png" alt="bouton ajouter commentaire" class="w-4"></button>
            </form>
        </article>

<?php 
        }

?>

    </section>

    <footer class="bg-black py-2 fixed bottom-0 left-0 w-full z-10 md:hidden">
    <nav class="flex justify-evenly items-center px-4">
        <!-- Icône de Test -->
        <img src="../../assets/icons/Test.png" alt="test icon" class="w-10 h-10 object-contain">

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
