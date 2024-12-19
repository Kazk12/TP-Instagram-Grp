<?php

require_once '../../connect/connectDB.php';

session_start();

$user_id = $_SESSION["pseudo"]["id"];



$sql = "SELECT * FROM photo where id_user = :id_user";

try {
    $query = $pdo->prepare($sql);
    $query->execute([":id_user" => $_SESSION["pseudo"]["id"] ]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
   
echo "Erreur lors de la requete : " . $error->getMessage();
}




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/output.css">
    <script DEFER type="module" src="../../assets/js/script.js"></script>
</head>
<body class="bg-black">
    <main class="px-4 py-6">

    <header class="flex justify-between py-3 items-center">
    <h1 class="font-logo bg-gradient-to-r from-blue-400 via-purple-600 to-pink-500 text-transparent bg-clip-text text-3xl font-bold pl-6 pt-4 mb-4 lg:text-5xl lg:mb-8">Aura.</h1>

        <nav class="flex justify-end gap-6 pr-4">
            <img src="../../assets/icons/ajouter-un-bouton.png" alt="" class="w-6 h-6">
            <img src="../../assets/icons/bars.png" alt="" class="w-6 h-6">
        </nav>
    </header>

 

    <section class="flex flex-col items-center ">
        <!-- Conteneur de l'image et de l'article en flex-row pour les aligner horizontalement -->
        <div class="flex flex-row p-2 gap-11 justify-center items-center  w-full mb-7  lg:justify-center lg:items-center  sm:justify-center sm:items-center sm:gap-[140px] md:justify-center md:items-center  ">
            <img class="w-[100px] md:w-[20%] sm:w-[20%] lg:w-[10%] rounded-full" src="../../Asta_Post-Timeskip_Black_Clover.webp" alt="Profile Picture">
            <article class="flex flex-row  gap-6 text-center md:text-center sm:text-left ">
                <div class="mb-2 text-[17px] text-white md:text-[20px]">126 <br> posts</div>
                <div class="mb-2 text-[17px] text-white md:text-[20px]">427 <br> followers</div>
                <div class="mb-2 text-[17px] text-white md:text-[20px]">472 <br> following</div>
            </article>
        </div>

        <div class="flex items-center gap-3">
            <p class="text-center font-semibold text-lg text-white"><span class="font-normal">Profil de:  </span> Rio</p>
        <p class="text-center text-gray-600">  Designer</p>
            </div>
     

            <div class="p-6 bg-gray-50 border-t">
            <form enctype="multipart/form-data" action="../../process/process_ajoutPhoto.php" method="post" class="space-y-6">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">

            
            <div class="space-y-2">
                <label for="photo" class="block text-lg font-medium text-gray-700">Choose an Image</label>
                <input type="file" name="photo" id="photo" accept="image/*" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

          
            <div class="space-y-2">
                <label for="texteimage" class="block text-lg font-medium text-gray-700">Description</label>
                <input type="text" name="texteimage" id="texteimage" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            
            <button type="submit" class="w-full bg-green-500 text-white py-3 rounded-lg text-lg font-semibold hover:bg-green-600 transition duration-300">Add Post</button>
        </form>
        </div>


        
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
         <a href="./ajoutPhoto.php">
         <img src="../../assets/icons/ajouter-un-bouton.png" alt="add button" class="w-12 h-12 object-contain">
         </a>

        <!-- Photo de l'utilisateur (profil) avec un lien -->
        <a href="../profil/profil.php">
            <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo de profil" class="w-10 h-10 rounded-full object-cover">
        </a>
    </nav>
</footer>



    </main>
</body>
</html>
