<?php

ini_set('display_errors', true);

require_once __DIR__ . '/vendor/autoload.php';

use Slim\Slim;

use comunic\social_network_analyzer\model\facade\mongo\FacadeFactory;
use comunic\social_network_analyzer\model\repository\mongo\MongoRepository;

$restapp = new Slim();

$mongo = new MongoRepository("development");
$factory = new FacadeFactory($mongo);

define('CONTROLLERS_PATH', __DIR__.'/src/comunic/social_network_analyzer/controllers/');

$controllerDir = opendir(CONTROLLERS_PATH); 
while ($controller = readdir($controllerDir)) { 
    if($controller != '.' && $controller != '..') {

        require CONTROLLERS_PATH . $controller; 
    } 
}

$restapp->get('/testarango/', function() {
    require_once 'testearango.php';
});



$restapp->run();
?>
