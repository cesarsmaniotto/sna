<h1>Teste</h1>


<?php
require_once 'autoload.php';

ini_set('display_errors', true);

use \comunic\social_network_analyzer\model\entity\parse\csv\CSVCategoryParser;
use comunic\social_network_analyzer\model\entity\parse\json\JsonCategoryParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonCategoryFormatter;
use comunic\social_network_analyzer\model\facade\FacadeFactory;
use comunic\social_network_analyzer\model\repository\mongo\MongoRepository;

$mongo = new MongoRepository();
$mfact = new FacadeFactory($mongo);
$categoryFacade = $mfact->instantiateCategories();

$filename = "/home/cesar/Área de Trabalho/biblioteca_termos.csv";
$arquivo = fopen($filename, "r");
$arquivolido = fread($arquivo, filesize($filename));

$csvparser = new CSVCategoryParser();
$csv = $csvparser->parse($arquivolido);



$formatter = new JsonCategoryFormatter();

$catJson = $formatter->format($csv);



$categoryFacade->insertAll($catJson, new JsonCategoryParser());



?>

