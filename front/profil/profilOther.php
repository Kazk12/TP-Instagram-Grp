<?php

require_once '../../connect/connectDB.php';

session_start();

$idP = $_GET["id"];



$sql = "SELECT photo.id_user, photo.url_photo, photo.texteImage, user.pseudo
 FROM photo 
 INNER JOIN user WHERE user.id = photo.id_user
 AND id_user = :id";

try {
    $query = $pdo->prepare($sql);
    $query->execute([":id" => $idP]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {

    echo "Erreur lors de la requete : " . $error->getMessage();
}



$sqlMessage = "SELECT * FROM `message` WHERE id_user = :id_user AND id_receveur = :id_receveur ";

try {
    $query = $pdo->prepare($sqlMessage);
    $query->execute([":id_receveur" => $idP , ":id_user" => $_SESSION['pseudo']['id']]);
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);

} 
catch (PDOException $error) {

    echo "Erreur lors de la requete : " . $error->getMessage();
}






$sqlRecu = "SELECT * FROM `message` WHERE id_user = :id_user AND id_receveur = :id_receveur ";

try {
    $query = $pdo->prepare($sqlRecu);
    $query->execute([":id_receveur" => $_SESSION['pseudo']['id'] , ":id_user" => $idP]);
    $messagesRecu = $query->fetchAll(PDO::FETCH_ASSOC);

} 
catch (PDOException $error) {

    echo "Erreur lors de la requete : " . $error->getMessage();
   
}

// var_dump($messages);
// var_dump($messagesRecu);
// die();

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/output.css">
    <script DEFER type="module" src="../../assets//js/script.js"></script>
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
                <p class="text-center font-semibold text-lg text-white"><span class="font-normal"><?= $result[0]["pseudo"] ?> </span> </p>
                <p class="text-center text-gray-600"> Designer</p>
            </div>

            <div class="fixed bottom-0 right-0 mb-4 mr-4">
                <button id="open-chat" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                   Envoyez un message
                </button>
            </div>
            <div id="chat-container" class="hidden fixed bottom-16 right-4 w-96">
                <div class="bg-white shadow-md rounded-lg max-w-lg w-full">
                    <div class="p-4 border-b bg-blue-500 text-white rounded-t-lg flex justify-between items-center">
                        <p class="text-lg font-semibold"><?= $result[0]["pseudo"]  ?> </p>
                        <button id="close-chat" class="text-gray-300 hover:text-gray-400 focus:outline-none focus:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>



                    <section class="mt-23">


                        <div id="chatbox" class="p-4 h-80 overflow-y-auto">
                            <!-- Chat messages will be displayed here -->
                             <?php foreach($messages as $message): ?>
                            <div class="mb-2 text-right">
                                <p class="bg-blue-500 text-white rounded-lg py-2 px-4 inline-block"><?= $message['content'] ?></p>
                            </div>
                            <?php endforeach; ?>
                            <?php foreach($messagesRecu as $recu): ?>
                              <div class="mb-2">
                                <p class="bg-gray-200 text-gray-700 rounded-lg py-2 px-4 inline-block"><?= $recu['content']  ?></p>
                            </div> 
                            <?php endforeach; ?>
                           <!-- <div class="mb-2 text-right">
                                <p class="bg-blue-500 text-white rounded-lg py-2 px-4 inline-block">this example of chat</p>
                            </div>
                            <div class="mb-2">
                                <p class="bg-gray-200 text-gray-700 rounded-lg py-2 px-4 inline-block">This is a response from the chatbot.</p>
                            </div>
                            <div class="mb-2 text-right">
                                <p class="bg-blue-500 text-white rounded-lg py-2 px-4 inline-block">design with tailwind</p>
                            </div>
                            <div class="mb-2">
                                <p class="bg-gray-200 text-gray-700 rounded-lg py-2 px-4 inline-block">This is a response from the chatbot.</p>
                            </div> -->
                        </div> 
                        <div class="p-4 border-t flex">
                            <form action="../../process/process_message.php" method="post">
                                <input type="hidden" name="id_receveur" value="<?= $result[0]['id_user'] ?>">
                            <input name="content"  type="text" placeholder="Type a message" class="w-full px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button  id="send-button" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300">Envoyez</button>
                            </form>
                        </div>
                    </section>

                </div>
            </div>






            <div class="flex flex-col gap-6 mt-6 ">


                <div class="flex flex-wrap gap-[2%] w-[375px] sm:w-auto sm:justify-center sm:items-center  lg:w-auto lg:justify-center lg:items-center lg:mt-24 2xl:w-auto">
                    <?php foreach ($result as $photo) {  ?>
                        <img src="../<?= $photo["url_photo"] ?>" alt="Post 1" class="w-[32%] sm:w-[30%] lg:w-[24%]  pb-2">

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