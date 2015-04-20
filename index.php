<?php

require_once './autoload.php';

use Slim\Slim;
use comunic\social_network_analyzer\model\facade\FacadeFactory;
use comunic\social_network_analyzer\model\repository\fake\FakeRepository;
use comunic\social_network_analyzer\model\entity\parse\json\JsonUserParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonUserFormatter;

$restapp = new Slim();

$repositoryFactory = new FakeRepository();
$ffact = new FacadeFactory($repositoryFactory);

$usF = $ffact->instantiateUsers();


$restapp->get('/user/json/:id', function($id) use($usF) {
    echo $usF->findById($id, new JsonUserFormatter());
});

$restapp->get('/user/json', function() use($usF) {
    echo $usF->listAll(new JsonUserFormatter());
});


$restapp->post('/user/json', function() use($usF, $restapp) {

    $usF->insert($restapp->request()->getBody(), new JsonUserParser());
});

$restapp->run();
?>
