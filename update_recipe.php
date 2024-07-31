<?php
// Connection à la BDD
require_once(__DIR__ . '/databaseconnect.php');

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo('Il faut un identifiant de recette pour la modifier.');
    return;
}


// Ecriture de la requête
$sqlQuery = 'SELECT * FROM recipes WHERE recipe_id = :id';

// Préparation
$recipesStatement = $mysqlClient->prepare($sqlQuery);

// Exécution
$recipesStatement->execute(['id' => (int)$getData['id']]);

$recipe = $recipesStatement->fetch(PDO::FETCH_ASSOC);

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Creation d'une recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
    <!-- inclusion de l'entête du site -->
    <?php require_once(__DIR__ . '/header.php'); ?>
    <h1>Modifiez votre recette</h1>
        <form action="post_update.php" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la recette</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($getData['id']); ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $recipe['title']?>">
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Description de la Recette</label>
                <textarea class="form-control" id="recipe" name="recipe" ><?php echo $recipe['recipe']?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <!-- inclusion du bas de page du site -->
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>