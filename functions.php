<?php
// Cette fonction permet de vérifier si une recette est valide
function isValidRecipe(array $recipe) : bool{
    $isEnabled = null;
    if(array_key_exists('is_enabled', $recipe) && $recipe['is_enabled']){
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }
    return $isEnabled;
}

// Cette fonction permet de récupérer les recettes valides
function getValidRecipes(array $recipes) : array {
    $validRecipes = [];
    foreach($recipes as $recipe){
        if(isValidRecipe($recipe)){
            $validRecipes[] = $recipe; // ajout de la recette au tableau
        }
    }
    return $validRecipes;
}

// Cette fonction affiche le nom de l'autheur
function displayAuthor(string $authorEmail, array $users) : string{
    foreach($users as $user){
        if($user['email'] === $authorEmail){
            return $user['full_name'].' ('.$user['age'].' ans)';
        }
    }
}

// Cette fonction redirige vers une page fournie en argument
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}
?>