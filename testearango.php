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
	array(	"text" => "opa RT @beboquerosene: Depois de Pásse Livre, a proxima exigência é a legalizaÇão da heroína em garrafa de 2 litros no supermercado",
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
	array(	"text" => "joinha RT @beboquerosene: Depois de Pásse Livre, a proxima exigência é a legalizaÇão da heroína em garrafa de 2 litros no supermercado",
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

// $repo->import($objects,"4556374541664");


// $category = new Category();
// $category->setName("Foo");
// $category->setKeywords(array("cobertura","conclamando","confirma.?","confronto","confusão","convoc.?","correm","correria","deslocam","detid.?","direito","dispers.?","durante","espancado","esquina","estação","ferid.?","fot.?","gritaria","hoje","image.?","imprensa","incidentes","interditad.?","jornalista","lata","lixo","lixeiras","manifesta.?","marcad.?","máscara","mascarado","metrô","militant.?","minut.?","mobilidade","momento","tenso","morador.?","altura","fardas","notícia","ocupa.?","ontem","pacífico","palácio","passeata","pedra","pedrada","periferia","PM.?","terror","agridem","políci.?","bate","população","predio","prefeitura","pres.?","prisões","quebra.?","queima.?","atirar","realiza.?","refugia.?","reivindica.?","relat.?","repressão","rolar.?","roleta","rolou","rua","ruas","santander","violência","simultane.?","trajeto","trânsito","transmi.?","tretas","tropa","truculência","tumulto","rolar","masp","veja","vídeo"));


// echo var_dump($cat->insert($category));

$options = array(
// 'skip' => 0,
// 'amount' => 20,
'sortBy' =>  'time',
'direction' => 'ASC');

$category = $cat->findById("4586473391456");

$tweets = $repo->findByCategory("4556374541664",$category,$options);


echo var_dump($tweets[0]->getAll());



// $tweet = $repo->findbyCategoryInAnInterval("4125249758686", $category,$options);

// echo var_dump($tweet);

// $options = array(
// 'skip' => 0,
// 'amount' => 20,
// 'sortBy' =>  'time',
// 'direction' => 'ASC');

// $result = $facade->findbyCategoryInAnInterval("189028959541", "94748935477", new JsonPaginator(new TweetToArray()), $options);


// echo var_dump($result);

// $result[]="passe";
// foreach ($result as $r) {
// 	echo md5($r);
// 	echo "<br>";
// }






// Iniciamos o "contador"
list($usec, $sec) = explode(' ', microtime());
$script_start = (float) $sec + (float) $usec;
 
// /* SEU CÓDIGO PHP */
//  $options = array(
//  'skip' => 0,
//  'amount' => 20,
//  'sortBy' =>  'time',
//  'direction' => 'ASC');

// $tweet = $repo->findbyCategory("4125249758686", $category,$options);

// echo var_dump($tweet);


// $repo->listInAnInterval("2778090575412", $options);

// Terminamos o "contador" e exibimos
list($usec, $sec) = explode(' ', microtime());
$script_end = (float) $sec + (float) $usec;
$elapsed_time = round($script_end - $script_start, 5);

// Exibimos uma mensagem
echo 'Elapsed time: ', $elapsed_time, ' secs. Memory usage: ', round(((memory_get_peak_usage(true) / 1024) / 1024), 2), 'Mb';




?>