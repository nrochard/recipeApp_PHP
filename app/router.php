<?php 

// Router classique

use App\Controllers\AppController;
use App\Controllers\RecipeController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = strtolower($_SERVER['REQUEST_METHOD']);

$appController = new AppController($twig);
$recipeController = new RecipeController($twig, $db);

switch ($method) {
    case 'get':
        switch ($uri) {
            case '/':
                $appController->index();
                break;
            case '/api':
                
                $recipeController->index();
                break;
            default:
                http_response_code(404);
                break;
        }
        break;  
        
    case 'post':
        $recipeController->postRecipe();
        break;
    default:
        break;
}


?>