<?php
// Connection à la BDD
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/functions.php');

$postData = $_POST;

if (!isset($postData['id']) || !is_numeric($postData['id'])) {
    echo 'Il faut un identifiant valide pour supprimer une recette.';
    return;
}

// Ecriture de la requête
$sqlQuery = 'DELETE FROM recipes WHERE recipe_id = :id';

// Préparation
$deleteRecipe = $mysqlClient->prepare($sqlQuery);

// Exécution ! La recette est supprimée en base de données
$deleteRecipe->execute([
    'id' => $postData['id']
]) or die(print_r($mysqlClient->errorInfo()));
redirectToUrl("index.php");
?>