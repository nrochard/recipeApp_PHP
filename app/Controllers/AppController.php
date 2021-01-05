<?php

namespace App\Controllers;
use App\Models\Recipe;

class AppController
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

        echo $this->twig->render('index.twig');
    }
}

?>