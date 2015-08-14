<h1>Teste Arango</h1>

<?php
require_once __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', true);


use comunic\social_network_analyzer\model\entity\mappers\ArrayToTweet;
use comunic\social_network_analyzer\model\repository\arango\TweetsRepository;
use comunic\social_network_analyzer\model\repository\arango\CategoriesRepository;
use comunic\social_network_analyzer\model\repository\arango\ArangoGraphHandler;
use comunic\social_network_analyzer\model\facade\arango\TweetsFacade;
use comunic\social_network_analyzer\model\entity\Project;
use comunic\social_network_analyzer\model\util\StringUtil;
use comunic\social_network_analyzer\model\entity\Category;
use comunic\social_network_analyzer\model\entity\format\json\JsonPaginator;
use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;

$tweets = array(
	array(	"text" => "opa RT @beboquerosene: Depois de Pásse Livre, a proxima exigência é a legalização da heroína em garrafa de 2 litros no supermercado",
	"fromUserId" => null,
	"idTweet" => "553315797247217664",
	"createdAt" => "Thu Jan 08 22:22:20 +0000 2015",
	"time" => "1420755740",
	'toUserId' => null,
	'fromUser' => "mpl_sp",
	'isoLanguageCode' => null,
	'source' => null,
	'profileImageUrl' => null,
	'geoType' => null,
	'geoCoordinates0' => null,
	'geoCoordinates1' => null),
	array(	"text" => "claroooo RT @beboquerosene: Depois de Pásse Livre, a proxima exigência é a legalização da heroína em garrafa de 2 litros no supermercado",
	"fromUserId" => null,
	"idTweet" => "553315797247217664",
	"createdAt" => "Thu Jan 08 22:22:20 +0000 2015",
	"time" => "1420755740",
	'toUserId' => null,
	'fromUser' => "mpl_sp",
	'isoLanguageCode' => null,
	'source' => null,
	'profileImageUrl' => null,
	'geoType' => null,
	'geoCoordinates0' => null,
	'geoCoordinates1' => null),
	array(	"text" => "joinha RT @beboquerosene: Depois de Pásse Livre, a proxima exigência é a legalização da heroína em garrafa de 2 litros no supermercado",
	"fromUserId" => null,
	"idTweet" => "553315797247217664",
	"createdAt" => "Thu Jan 08 22:22:20 +0000 2015",
	"time" => "1420755740",
	'toUserId' => null,
	'fromUser' => "mpl_sp",
	'isoLanguageCode' => null,
	'source' => null,
	'profileImageUrl' => null,
	'geoType' => null,
	'geoCoordinates0' => null,
	'geoCoordinates1' => null)
	);

// $fArrayToTweet = new ArrayToTweet();
// $objects = array();
// foreach ($tweets as $tweet) {
// 	$objects[] = $fArrayToTweet($tweet);
// }


// $repo = new TweetsRepository();
// // $cat = new CategoriesRepository();

// // echo var_dump($repo->listInAnInterval("93496805839", 0, 25));
// $category = new Category();
// $category->setName("Foo");
// $category->setKeywords(array("opa"));

// $tweet = $repo->findbyCategoryInAnInterval("176869624", $category,0,20);

// echo var_dump($tweet);

// $result = $repo->listInAnInterval(1,3);

// echo var_dump($result);

// $facade = new TweetsFacade($repo,$cat);

// $result = $facade->findbyCategoryInAnInterval("93496805839", $category,new JsonPaginator(new TweetToArray()),0,20);

// echo var_dump($result);

$graphHandler = new ArangoGraphHandler();



echo var_dump($graphHandler->import("tweets", $tweets));

?>