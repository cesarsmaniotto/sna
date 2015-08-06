<?php

ini_set('display_errors', true);

require_once __DIR__ . '/vendor/autoload.php';

use Slim\Slim;

use comunic\social_network_analyzer\model\facade\arango\FacadeFactory;
use comunic\social_network_analyzer\model\repository\arango\ArangoRepository;

$restapp = new Slim();

$arango = new ArangoRepository();
$factory = new FacadeFactory($arango);

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
