<?php

session_start();

if (isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])) {
    // header('Location: ./front/accueil/accueil.php');
    // exit;
}
// var_dump($_SESSION);
// die();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/output.css">
  
</head>

<body class="bg-black ">
    <main class="pt-[15%] flex flex-col xl:pt-[10%]">
        <form action="./process/process_login.php" method="post">
        <section>
            <h1 class=" text-center font-logo font-bold text-[59px] bg-gradient-to-r from-blue-400 via-purple-600 to-pink-500 text-transparent bg-clip-text">Aura.</h1>
            <div class="flex flex-col gap-2 items-center mt-20">
                <input
                    type="text"
                    name="pseudo"
                    placeholder="Nom d'utilisateur"
                    class="w-[340px] p-[8px] mb-3 text-white border rounded-md border-[#262626] bg-[#262626] focus:outline-none focus:ring-2 focus:ring-violet" />


               
                <input
                    type="password"
                   name="mdp"
                    placeholder="Mot de passe"
                    class="w-[340px] p-[8px] mb-4 border text-white rounded-md border-[#262626] bg-[#262626] focus:outline-none focus:ring-2 focus:ring-violet" />

                    <?php if(isset($_SESSION["mdp-incorect"])): ?>
                    <p class="text-white"><?= $_SESSION["mdp-incorect"]?></p>
                    <?php unset($_SESSION["mdp-incorect"]); ?>
                    
                    <?php endif; ?>
                <input
                    type="submit"
                    value="Connexion"
                    class="w-[340px] p-[8px] bg-violet text-white font-bold rounded-md cursor-pointer hover:bg-blue-600" />
                >
            </div>
        </section>
        </form>

    </main>



</body>

</html>