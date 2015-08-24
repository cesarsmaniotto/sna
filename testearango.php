<h1>Teste Arango</h1>

<?php
require_once __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', true);


use comunic\social_network_analyzer\model\entity\mappers\ArrayToTweet;
use comunic\social_network_analyzer\model\entity\mappers\WordToArray;
use comunic\social_network_analyzer\model\repository\arango\TweetsRepository;
use comunic\social_network_analyzer\model\repository\arango\CategoriesRepository;
use comunic\social_network_analyzer\model\repository\arango\ArangoGraphHandler;
use comunic\social_network_analyzer\model\facade\arango\TweetsFacade;
use comunic\social_network_analyzer\model\entity\Project;
use comunic\social_network_analyzer\model\entity\Word;
use comunic\social_network_analyzer\model\entity\Tweet;
use comunic\social_network_analyzer\model\util\StringUtil;
use comunic\social_network_analyzer\model\entity\Category;
use comunic\social_network_analyzer\model\entity\format\json\JsonPaginator;
use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;
use comunic\social_network_analyzer\model\entity\parse\csv\CSVTweetParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonTweetFormatter;
use comunic\social_network_analyzer\model\entity\format\csv\CSVTweetFormatter;
use comunic\social_network_analyzer\model\entity\writers\EntityToCSV;
use comunic\social_network_analyzer\model\util\DownloadFile;


$tweets = array(
	array(	"text" => "opa RT @beboquerosene: Depois de Pásse Livre, a proxima exigência é a legalização da heroína em garrafa de 2 litros no supermercado",
	"fromUserId" => null,
	"id" => "553315797247217664",
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
	"id" => "553315797247217663",
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
	"id" => "553315797247217662",
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

$fArrayToTweet = new ArrayToTweet();
$objects = array();
foreach ($tweets as $tweet) {
	$objects[] = $fArrayToTweet($tweet);
}


$repo = new TweetsRepository();
$cat = new CategoriesRepository();


// $category = new Category();
// $category->setName("Foo");
// $category->setKeywords(array("Ach.?", "Adoro", "Apoio", "argumento", "Concordo", "Defendo", "Desabafo", "Diálog.?", "Discut.?", "Galera", "Gente", "gostaria de saber", "Gostei", "Indignad.?", "lido e aplaudido", "Manoo", "né", "Olha", "Olhae", "Por que", "Pq", "Qual o sentido", "Que tal", "Quer.?", "question.?", "Repito", "Respond.?", "Será que", "Sério que", "Sinto", "tenho direito", "Vc quis dizer", "Xatiad.?", "Junho de 2013", "Sobre o ato", "Transporte como mercadoria", "esperando respostas", "migos", "pilho", "eai", "cheguei", "conclusão", "fera"));

// $tweet = $repo->findbyCategoryInAnInterval("176869624", $category,0,20);

// echo var_dump($tweet);

// $result = $repo->listInAnInterval(1,3);

// echo var_dump($result);

// $facade = new TweetsFacade($repo,$cat);


// $options = array(
// 'skip' => 0,
// 'amount' => 20,
// 'sortBy' =>  'time',
// 'direction' => 'ASC');

// $result = $facade->findbyCategoryInAnInterval("3075647380220", "3150162795260", new JsonPaginator(new TweetToArray()), $options);


// echo var_dump($result);

// $result[]="passe";
// foreach ($result as $r) {
// 	echo md5($r);
// 	echo "<br>";
// }

// $graphHandler = new ArangoGraphHandler();


// // Iniciamos o "contador"
// list($usec, $sec) = explode(' ', microtime());
// $script_start = (float) $sec + (float) $usec;
 
// /* SEU CÓDIGO PHP */
//  $options = array(
//  'skip' => 0,
//  'amount' => 20,
//  'sortBy' =>  'time',
//  'direction' => 'ASC');


// $repo->listInAnInterval("2778090575412", $options);

// // Terminamos o "contador" e exibimos
// list($usec, $sec) = explode(' ', microtime());
// $script_end = (float) $sec + (float) $usec;
// $elapsed_time = round($script_end - $script_start, 5);

// // Exibimos uma mensagem
// echo 'Elapsed time: ', $elapsed_time, ' secs. Memory usage: ', round(((memory_get_peak_usage(true) / 1024) / 1024), 2), 'Mb';


// echo var_dump($graphHandler->getEdgesWithVertices("datasets/1303374276614","datasets_tweets_belong"));

// echo var_dump($repo->import($objects,"621332107006"));

$filename = "/home/cesar/datasets/teste.csv";
$arquivo = fopen($filename, "r");
$arquivolido = fread($arquivo, filesize($filename));

$csvparser = new CSVTweetParser();
$tweets = $csvparser->parse($arquivolido);

echo var_dump($tweets);

// $repo->import($tweets,"145279421605");


// $csv = new CSVTweetFormatter();

// echo var_dump($csv->format($objects));

?>