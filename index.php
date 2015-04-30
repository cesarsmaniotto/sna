<?php

ini_set('display_errors', true);

require_once './autoload.php';

use Slim\Slim;
use comunic\social_network_analyzer\model\facade\FacadeFactory;
use comunic\social_network_analyzer\model\repository\fake\FakeRepository;
use comunic\social_network_analyzer\model\entity\parse\json\JsonUserParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonUserFormatter;

use comunic\social_network_analyzer\model\repository\mongo\MongoRepository;
use comunic\social_network_analyzer\model\entity\parse\json\JsonCategoryParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonCategoryFormatter;


use comunic\social_network_analyzer\model\entity\parse\json\JsonTweetParser;
use comunic\social_network_analyzer\model\entity\format\json\BasicObjectFormatter;
use comunic\social_network_analyzer\model\entity\format\json\JsonTweetFormatter;

$restapp = new Slim();

$repositoryFactory = new FakeRepository();
$ffact = new FacadeFactory($repositoryFactory);

$usF = $ffact->instantiateUsers();


$restapp->get('/tudo', function()  {
    require_once 'teste.php';
});

$restapp->get('/user/json/:id', function($id) use($usF) {
    echo $usF->findById($id, new BasicObjectFormatter(function($obj) {

            return
                    array(
                        "id" => $obj->getId(),
                        "name" => $obj->getName()
            );
        }));
});

$restapp->get('/user/json', function() use($usF) {
    echo $usF->listAll(new BasicObjectFormatter(function($obj) {

            return
                    array(
                        "id" => $obj->getId(),
                        "name" => $obj->getName()
            );
        }));
});


$restapp->post('/user/json', function() use($usF, $restapp) {

    $usF->insert($restapp->request()->getBody(),new BasicObjectFormatter(function($obj) {

            return
                    array(
                        "id" => $obj->getId(),
                        "name" => $obj->getName()
            );
        }));
});





 $mongo = new MongoRepository();
 $mfact = new FacadeFactory($mongo);

 $cat_mongo = $mfact->instantiateCategories();

$restapp->get('/categories/json', function() use ($cat_mongo){

    echo $cat_mongo->listAll(new JsonCategoryFormatter());
});

$restapp->get('/categories/:id/json', function($id) use ($cat_mongo){

    echo $cat_mongo->findById($id,new JsonCategoryFormatter());
});

$restapp->post('/categories/json', function() use ($cat_mongo,$restapp){

    echo $cat_mongo->insert($restapp->request()->getBody(),new JsonCategoryParser());
});

$restapp->put('/categories/json', function() use ($cat_mongo,$restapp){

    echo $cat_mongo->update($restapp->request()->getBody(),new JsonCategoryParser());
});

$restapp->delete('/categories/:id/json', function($id) use ($cat_mongo){

    echo $cat_mongo->delete($id);
});

$twt_mongo = $mfact->instantiateTweets();

$restapp->get('/tweets/json' , function() use($twt_mongo){
    echo $twt_mongo->listAll(new JsonTweetFormatter());
});

$restapp->get('/tweets/:id/json' , function($id) use($twt_mongo){
    echo $twt_mongo->findById($id,new JsonTweetFormatter());
});

$restapp->run();



?>
