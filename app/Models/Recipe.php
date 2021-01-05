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
        if (!isset($_POST['name']) or !isset($_POST['preparation']) or !isset($_POST['ingredients']) or !isset($_POST['time']) or !isset($_POST['people'])) {
            http_response_code(400);
            return;
        }

        $statement = $this->db->prepare('INSERT INTO recipes (name, ingredients, preparation, time, people) VALUES (:name, :ingredients, :preparation, :time, :people)');
        $statement->execute([
            'name' => $_POST['name'],
            'ingredients' => $_POST['ingredients'],
            'preparation' => $_POST['preparation'],
            'time' => $_POST['time'],
            'people' => $_POST['people'],
        ]);
        $statement = $this->db->prepare('SELECT * FROM recipes WHERE id = :id');
        $statement->execute(['id' => $this->db->lastInsertId()]);
        $recipe = json_encode($statement->fetchObject());
        return $recipe;
    }
    public function deleteRecipe(){
        $payload = json_decode(file_get_contents("php://input"));

        if (!isset($payload->id)) {
            http_response_code(400);
            return;
        }

        $statement = $this->db->prepare('DELETE FROM recipes WHERE id = :id');
        $statement->execute(['id' => $payload->id]);
        $recipe = json_encode(['id' => $payload->id]);
        return $recipe;
    }
}

?>