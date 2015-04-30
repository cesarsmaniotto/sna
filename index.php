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


 $mongo = new MongoRepository();
 $mfact = new FacadeFactory($mongo);

 $categoryFacade = $mfact->instantiateCategories();

$restapp->get('/categories/json', function() use ($categoryFacade){

    echo $categoryFacade->listAll(new JsonCategoryFormatter());
});

$restapp->get('/categories/json/:id', function($id) use ($categoryFacade){

    echo $categoryFacade->findById($id,new JsonCategoryFormatter());
});

$restapp->post('/categories/json', function() use ($categoryFacade,$restapp){

    echo $categoryFacade->insert($restapp->request()->getBody(),new JsonCategoryParser());
});

$restapp->put('/categories/json', function() use ($categoryFacade,$restapp){

    echo $categoryFacade->update($restapp->request()->getBody(),new JsonCategoryParser());
});

$restapp->delete('/categories/json/:id', function($id) use ($categoryFacade){

    echo $categoryFacade->delete($id);
});

$tweetFacade = $mfact->instantiateTweets();

$restapp->get('/tweets/json' , function() use($tweetFacade){
    echo $tweetFacade->listAll(new JsonTweetFormatter());
});

$restapp->get('/tweets/json/:id' , function($id) use($tweetFacade){
    echo $tweetFacade->findById($id,new JsonTweetFormatter());
});

$restapp->get('/tweets/json/find_by_category/:idCat' , function($idCat) use($tweetFacade){
    echo $tweetFacade->findByCategory($idCat,new JsonTweetFormatter());
});

$restapp->run();



?>
