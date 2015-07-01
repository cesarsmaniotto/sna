<h1>Teste</h1>


<?php
require_once __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', true);

// use \comunic\social_network_analyzer\model\entity\parse\csv\CSVCategoryParser;
use comunic\social_network_analyzer\model\entity\parse\json\JsonCategoryParser;
use comunic\social_network_analyzer\model\util\IdMongoGenerator;
use comunic\social_network_analyzer\model\entity\Category;
// use comunic\social_network_analyzer\model\entity\format\json\JsonCategoryFormatter;
// use comunic\social_network_analyzer\model\facade\FacadeFactory;
// use comunic\social_network_analyzer\model\repository\mongo\MongoRepository;

// $mongo = new MongoRepository();
// $mfact = new FacadeFactory($mongo);
// $categoryFacade = $mfact->instantiateCategories();

// $filename = "/home/cesar/Downloads/Biblioteca-Novafiltragem(3).csv";
// $arquivo = fopen($filename, "r");
// $arquivolido = fread($arquivo, filesize($filename));

// $csvparser = new CSVCategoryParser();
// $csv = $csvparser->parse($arquivolido);



// $formatter = new JsonCategoryFormatter();

// $catJson = $formatter->format($csv);



// $categoryFacade->insertAll($catJson, new JsonCategoryParser());

$idMongo=new IdMongoGenerator();
$catId = $idMongo();

$jsonCategory = '[{"name":"FooCategory","keywords":["FooKw","BarKw"],"included":null,"excluded":null,"id":"'.$catId.'"},{"name":"FooCategory","keywords":["FooKw","BarKw"],"included":null,"excluded":null,"id":"'.$catId.'"}]';
$parser = new JsonCategoryParser();

echo var_dump(\json_decode($jsonCategory,true));

echo "<br><br>";

echo var_dump($parser->parse($jsonCategory));



?>