<?php 

require_once '../../connect/connectDB.php';
session_start();
// var_dump($_SESSION);
// die();

$img = $_GET['id'];
// var_dump($img);
// die();

$sql =  " SELECT commentaire.sms , user.pseudo   FROM `commentaire`
 INNER JOIN user  WHERE  user.id = commentaire.id_user AND  commentaire.id_photo = :img";

try {
  $stmt = $pdo->prepare($sql);
  $stmt->execute([":img" => $img ]);
  $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC); 


} catch (PDOException $error) {
  echo "Erreur lors de la requête : " . $error->getMessage();
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
    
    <article class="flex flex-col gap-3">
        <div class="flex items-center justify-between px-3">
            <div class="flex items-center gap-2">
                <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo de singe" class="w-10 rounded-full">
                
                <p class="text-white font-sans font-medium text-sm"> pseudo</p>
               
            </div>
            <img src="../../assets/icons/doubler.png" alt="menu petits points" class="w-4">
        </div>
        <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo d'utilisateur" 
     class="w-full h-auto sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 mx-auto">
        <div class="flex w-6 gap-2 ml-4">
           
        </div>
     
        
    </article>


    <article class="flex flex-col gap-2 xl:justify-center px-4 md:px-6 lg:px-8">
    <?php foreach($commentaires as $commentaire) { 
  
      ?>

  <div class="flex items-start p-2 gap-3 sm:p-3 md:p-4">
    <img src="../../GTzblVSWUAAIMp-.jpg" alt="photo de singe" class="w-10 rounded-full">
    <p class="text-white font-sans font-medium text-sm sm:text-base md:text-lg">
      <span class="block font-medium"><?= $commentaire['pseudo'] ?></span>
      <span class="font-light text-red-400"><?= $commentaire['sms'] ?></span>
    </p>
  </div>
  <?php } ?>
    </article>

    
  



<form action="../../process/process_commentaire.php"   method="post" class="flex items-center justify-between px-3">
    
            <input type="text" name="sms" id="sms" placeholder="Ajoutez un commentaire" class="bg-black text-white">
            <input type="hidden" name="id" id="id" value="<?= $img ?>" placeholder="Ajoutez un commentaire" class="bg-black text-white">
            <button type="submit" ><img src="../../assets/icons/ajouter-un-bouton.png" alt="bouton ajouter commentaire" class="w-4"></button>
        </form> 

    </section>
</main>

</body>
</html>