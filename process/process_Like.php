

<?php

// require_once '../connect/connectDB.php';
// session_start();


// var_dump($_SESSION);

// $like1Fois = "SELECT * FROM `photoaime` WHERE photoaime.id_user = :id_user AND photoaime.id_photo = :id_photo";

// try {
//     $stmt = $pdo->prepare($like1Fois);
//     $LIKES = $stmt->execute([
//         ':id_photo' => $_POST["idDeLaPhoto"],
//         ':id_user' => $_SESSION["pseudo"]['id']
//     ]); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat
//     $LikeExist = $LIKES->fetchAll(PDO::FETCH_ASSOC);




// } catch (PDOException $error) {
//     echo "Erreur lors de la requete : " . $error->getMessage();
// }


// var_dump($like1Fois);
// die;

// $sql = "INSERT INTO photoaime (id_photo, id_user)
//  VALUES (:id_photo, :id_user )";

// try {
//     $stmt = $pdo->prepare($sql);
//     $users = $stmt->execute([
//         ':id_photo' => $_POST["idDeLaPhoto"],
//         ':id_user' => $_SESSION["pseudo"]['id']
//     ]); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat




// } catch (PDOException $error) {
//     echo "Erreur lors de la requete : " . $error->getMessage();
// }


// header("Location: ../front/accueil/accueil.php");
// exit;


?>


<?php

require_once '../connect/connectDB.php';
session_start();

// Vérifie si les données nécessaires existent dans $_POST et $_SESSION
if (isset($_POST["idDeLaPhoto"]) && isset($_SESSION["pseudo"]['id'])) {
    
    // Récupérer l'ID de la photo et l'ID de l'utilisateur
    $id_photo = $_POST["idDeLaPhoto"];
    $id_user = $_SESSION["pseudo"]['id'];

    // Vérifie si l'utilisateur a déjà liké cette photo
    $checkSql = "SELECT COUNT(*) FROM photoaime WHERE id_photo = :id_photo AND id_user = :id_user";
    try {
        $stmt = $pdo->prepare($checkSql);
        $stmt->execute([
            ':id_photo' => $id_photo,
            ':id_user' => $id_user
        ]);
        
        // Récupérer le nombre de likes pour cette photo de cet utilisateur
        $likeCount = $stmt->fetchColumn(); // fetchColumn() renvoie la première colonne du premier résultat

        if ($likeCount > 0) {
                 // Si l'utilisateur a déjà liké cette photo, on la supprime (déliker)
                 $deleteSql = "DELETE FROM photoaime WHERE id_photo = :id_photo AND id_user = :id_user";
                 $stmt = $pdo->prepare($deleteSql);
                 $stmt->execute([
                     ':id_photo' => $id_photo,
                     ':id_user' => $id_user
                 ]);

        } else {
            // Si aucun like n'existe, on insère le like
            $insertSql = "INSERT INTO photoaime (id_photo, id_user) VALUES (:id_photo, :id_user)";
            $stmt = $pdo->prepare($insertSql);
            $stmt->execute([
                ':id_photo' => $id_photo,
                ':id_user' => $id_user
            ]);
            
            echo "Like ajouté avec succès!";
        }

    } catch (PDOException $error) {
        echo "Erreur lors de la requête : " . $error->getMessage();
    }
} else {
    echo "Données manquantes ou session expirée.";
}

header("Location: ../front/accueil/accueil.php");
exit;

?>



