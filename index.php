<?php
// ROUTER servant à la redirection des pages pour le modèle MVC
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/index.php' :
        require __DIR__ . '/views/accueil.php';
        break;
    
    case '/' :
        require __DIR__ . '/views/accueil.php';
        break;
    
    case '/inscription' :
        require __DIR__ . '/views/inscription-connexion.php';
        break;
    
    case '/agenda' :
        require __DIR__ . '/views/agenda.php';
        break;
    
    default: 
        require __DIR__ . '/views/errors/error_404.php';
        break;
}
?>

