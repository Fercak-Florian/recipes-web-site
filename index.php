<?php
    session_start(); // Démarre le système de sessions
    require_once(__DIR__ . '/variables.php');
    require_once(__DIR__ . '/functions.php');
?>
<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- inclusion de l'entête du site -->
        <?php require_once(__DIR__ . '/header.php'); ?>
        
        <h1>Site de recettes</h1>
        
        <!-- inclusion du formulaire de connexion -->
        <?php require_once(__DIR__ . '/login.php'); ?>
        
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <?php foreach (getValidRecipes($recipes) as $recipe) : ?>
            <article>
                <h3><a href="recipe_read.php?id=<?php echo($recipe['recipe_id']); ?>"><?php echo $recipe['title']; ?></a></h3>
                <div><?php echo $recipe['recipe']; ?></div>
                <i><?php echo displayAuthor($recipe['author'], $users); ?></i>
                <?php if (isset($_SESSION['LOGGED_USER']) && $recipe['author'] === $_SESSION['LOGGED_USER']) : ?>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item"><a class="link-warning" href="update_recipe.php?id=<?php echo($recipe['recipe_id']); ?>">Editer l'article</a></li>
                        <li class="list-group-item"><a class="link-danger" href="delete_recipe.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer l'article</a></li>
                    </ul>
                <?php endif; ?>
            </article>
        <?php endforeach ?>
        <?php endif; ?>
    </div>
    <!-- inclusion du bas de page du site -->
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>


</html>