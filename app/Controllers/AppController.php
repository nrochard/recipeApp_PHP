<?php

namespace App\Controllers;

class AppController
{
    protected $twig;
    public function __construct($twig)
    {
        $this->twig = $twig;
    }
    public function index()
    {
        echo $this->twig->render('index.twig');
    }
}

?>