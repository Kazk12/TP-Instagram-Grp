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

<main class="pb-16"> <!-- Ajout de padding-bottom pour éviter que le footer ne cache le contenu -->
    <section>
        <article class="flex flex-col gap-3 lg:gap-8 xl:px-96 ">
            <div class="flex items-center justify-between px-3">
                <div class="flex items-center gap-2">
                    <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo de singe" class="w-10 rounded-full">
                    <p class="text-white font-sans font-medium text-sm">Pseudo-Guy</p>
                </div>
                <img src="../../assets/icons/doubler.png" alt="menu petits points" class="w-4">
            </div>
            <div class="flex justify-center lg:h-[600px]">
                <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo d'utilisateur" height="100%" width="auto"> 
            </div>
            <div class="flex w-6 gap-2 ml-4">
                <img src="../../assets/icons/contour-en-forme-de-coeur.png" alt="bouton j'aime">
                <img src="../../assets/icons/commentaire.png" alt="bouton commentaire">
            </div>
            <p class="text-white px-3">Liked by 6 users</p>
            <p class="text-white px-3">Pseudo : #NouvellePhotoDeProfil #Bg #-10000Aura</p>
            <a href="../commentaire/commentaire.php" class="text-white px-3">View all comments</a>
            <form action="" method="post" class="flex items-center justify-between px-3">
                <input type="text" name="commentaire" id="commentaire" placeholder="Add a comment..." class="bg-black text-white">
                <button type="submit"><img src="../../assets/icons/ajouter-un-bouton.png" alt="bouton ajouter commentaire" class="w-4"></button>
            </form>
        </article>
    </section>

    <footer class="bg-black py-2 fixed bottom-0 left-0 w-full z-10 md:hidden">
        <nav class="flex justify-evenly items-center px-4">
            <!-- Icône de Test -->
            <img src="../../assets/icons/Test.png" alt="test icon" class="w-10 h-10 object-contain">

            <!-- Icône Loupe (recherche) -->
            <img src="../../assets/icons/Loupe_1.png" alt="search icon" class="w-10 h-10 object-contain">

            <!-- Icône Ajouter (post) -->
            <img src="../../assets/icons/ajouter-un-bouton.png" alt="add button" class="w-12 h-12 object-contain">

            <!-- Photo de l'utilisateur (profil) -->
            <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo de profil" class="w-10 h-10 rounded-full object-cover">
        </nav>
    </footer>
</main>

</body>
</html>
