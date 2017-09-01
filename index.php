<?php 

use OQuiz\App;

require_once('vendor/autoload.php');

// Erreurs en fonction de l'ENV
switch (ENV) {
  case 'dev':
    error_reporting(-1);
    ini_set('display_errors', 1);
  break;
  case 'test':
  case 'prod':
    ini_set('display_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
  break;
  default:
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'The application environment is not set correctly.';
    exit(1); // EXIT_ERROR
}

// On lance l'app
$app = new App();
$app->run();

?>
