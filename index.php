<?php

require_once './src/autoload.php';

use comunic\social_network_analyzer\model\facade\FacadeFactory;
use comunic\social_network_analyzer\model\repository\fake\FakeRepository;
use comunic\social_network_analyzer\model\entity\parse\json\JsonUserParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonUserFormatter;

$repositoryFactory = new FakeRepository();
$ffact = new FacadeFactory($repositoryFactory);


$usF = $ffact->instantiateUsers();


$parser = new JsonUserParser();
$fmt = new JsonUserFormatter();


$usF->insert(\json_encode(array("name"=>"jean carlos")), $parser);

echo $usF->findById(0, $fmt);
echo "<br>";
echo $usF->listAll($fmt);
echo "<br>";
echo "fim <br>";
?>
