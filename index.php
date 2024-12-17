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
            <h1 class=" text-center font-logo font-bold text-[59px] text-violet">Aura.</h1>
            <div class="flex flex-col gap-2 items-center mt-20">
                <input
                    type="text"
                    name="user"
                    placeholder="Nom d'utilisateur"
                    class="w-[340px] p-[8px] mb-3 text-white border rounded-md border-[#262626] bg-[#262626] focus:outline-none focus:ring-2 focus:ring-violet" />

                <input
                    type="password"
                   name="password"
                    placeholder="Mot de passe"
                    class="w-[340px] p-[8px] mb-4 border text-white rounded-md border-[#262626] bg-[#262626] focus:outline-none focus:ring-2 focus:ring-violet" />

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