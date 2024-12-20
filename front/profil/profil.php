<?php

require_once '../../connect/connectDB.php';

session_start();



$sql = "SELECT * FROM photo where id_user = :id_user";

try {
    $query = $pdo->prepare($sql);
    $query->execute([":id_user" => $_SESSION["pseudo"]["id"] ]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
   
echo "Erreur lors de la requete : " . $error->getMessage();
}

$pseudoProfil = $_SESSION["pseudo"]["pseudo"];




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


    <section>
<nav class="hidden lg:flex lg:justify-center lg:gap-16 lg:items-center lg:px-4 lg:fixed   ">
        <!-- Icône de Test -->
         <a href="../accueil/accueil.php">
         <img src="../../assets/icons/Test.png" alt="test icon" class="lg:w-6 lg:h-10 lg:object-contain">
         </a>

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
            <p class="text-center font-semibold text-lg text-white"><span class="font-normal"></span> <?=$pseudoProfil?></p>
        <p class="text-center text-gray-600">  Designer</p>
            </div>
      <a href="./ajoutPhoto.php">
      <button type="button" class="w-full sm:w-full bg-gradient-to-r from-[#020024] to-[#02d4ffcc] rounded py-2 mt-4 text-white">
    Ajouter une photo
</button>
      </a>
            

        <div class="flex flex-col gap-6 mt-6 ">
            

        <div class="flex flex-wrap gap-[2%] w-[375px] sm:w-auto sm:justify-center sm:items-center  lg:w-auto lg:justify-center lg:items-center lg:mt-24 2xl:w-auto">
        <?php foreach ($result as $photo){  ?>  
  <img src="../<?=$photo["url_photo"]?>" alt="Post 1" class="w-[32%] sm:w-[30%] lg:w-[24%]  pb-2">

<?php 
        }
        ?>

 
</div>

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
