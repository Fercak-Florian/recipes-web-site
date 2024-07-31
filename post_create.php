<?php
session_start(); // Permet la gestion des variables de session
// Connection à la BDD
require_once(__DIR__ . '/databaseconnect.php');
/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

// Validation du formulaire
if (isset($postData['title']) && isset($postData['recipe'])) {
    /*if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        // Il y a un problème dans l'email envoyé, on set la variable $_SESSION avec un message d'erreur
        //$_SESSION['LOGIN_ERROR_MESSAGE'] = 'Il faut un email valide pour soumettre le formulaire.';
        // Gerer le cas ou il y a une erreur dans les informations reçues
    }*/

$title = $postData['title'];
$recipe = $postData['recipe'];

// Ecriture de la requête
$sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)';

// Préparation
$insertRecipe = $mysqlClient->prepare($sqlQuery);

// Exécution ! La recette est maintenant en base de données
$insertRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
    'author' => $_SESSION['LOGGED_USER'],
    'is_enabled' => 1, // 1 = true, 0 = false
]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">

        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Recette ajoutée avec succès !</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo($title); ?></h5>
                <p class="card-text"><b>Email</b> : <?php echo($_SESSION['LOGGED_USER']); ?></p>
                <p class="card-text"><b>Recette</b> : <?php echo($recipe); ?></p>
            </div>
        </div>
    </div>
    <!-- inclusion du bas de page du site -->
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>