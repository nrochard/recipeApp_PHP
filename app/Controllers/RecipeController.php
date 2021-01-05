<?php 

namespace App\Controllers;
use App\Models\Recipe;

class RecipeController 
{
    protected $twig;
    protected $db;
    public function __construct($twig, $db)
    {
        $this->twig = $twig;
        $this->db = $db;
    }
    public function index()
    {
        header('Content-Type: application/json');
        $recipe = new Recipe($this->db);
        $recipes = $recipe->getAllRecipes();
        echo $recipes;
    }
    public function post()
    {
        header('Content-Type: application/json');
        $recipe = new Recipe($this->db);
        $recipes = $recipe->postRecipe();
        echo $recipes;
    }
    public function delete()
    {
        header('Content-Type: application/json');
        $recipe = new Recipe($this->db);
        $recipes = $recipe->deleteRecipe();
    }    
}

?>