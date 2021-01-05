<?php 

namespace App\Models;

class Recipe
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getAllRecipes(){
        $statement = $this->db->query('SELECT * FROM recipes');
        $recipes = json_encode($statement->fetchAll(\PDO::FETCH_OBJ));
        return $recipes;
    }
    public function postRecipe(){
        
    }
}

?>