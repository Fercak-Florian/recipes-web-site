<?php
// Connection à la BDD
require_once(__DIR__ . '/databaseconnect.php');
// Récupération des recettes en BDD
$sqlQueryForRecipes = 'SELECT * FROM recipes';
$recipesStatement = $mysqlClient->prepare($sqlQueryForRecipes);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

// Récupération des utilisateurs en BDD
$sqlQueryForUsers = 'SELECT * FROM users';
$recipesStatement = $mysqlClient->prepare($sqlQueryForUsers);
$recipesStatement->execute();
$users = $recipesStatement->fetchAll();

?>