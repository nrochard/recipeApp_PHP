<?php 

require __DIR__ . '/../vendor/autoload.php';



$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . "/../");
$dotenv->load();

try{
    $db = new PDO("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
}
catch (PDOException $exception) //$e contiendra les éventuels messages d’erreur
{
    die( 'Erreur : ' . $exception->getMessage() );
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . "/../views");
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$lexer = new \Twig\Lexer($twig, [
    'tag_comment'   => ['{#', '#}'],
    'tag_block'     => ['{%', '%}'],
    'tag_variable'  => ['[[', ']]'],
    'interpolation' => ['#{', '}'],
]);
$twig->setLexer($lexer);



if (!empty($_POST['_method'])) {
    $_SERVER['REQUEST_METHOD'] = $_POST['_method'];
}

require __DIR__ . "/../app/router.php";


?>