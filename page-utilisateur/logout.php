<?php
// Démarrez la session
session_start();

// Détruisez toutes les variables de session
$_SESSION = array();

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers la page de destination après la déconnexion
header("Location: ../landing_page/home.html");
exit;
?>
