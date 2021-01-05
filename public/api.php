<?php 

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . "/../");
$dotenv->load();


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

echo $twig->render('index.twig');

?>