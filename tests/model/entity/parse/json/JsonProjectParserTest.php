<?php

namespace sna\tests\model\entity\parse\json{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\parse\json\JsonProjectParser;
    use comunic\social_network_analyzer\model\entity\Project;

    class JsonProjectParserTest extends PHPUnit_Framework_TestCase{

        public function testParse(){

            $jsonTextProject = '{"id":"54202c79d1c82dc01a000034","name":"FooProject"}';
            $jsonObjProject = \json_decode($jsonTextProject);
            $parser = new JsonProjectParser();
            $projectObj = $parser->parse($jsonTextProject);

            $this->assertEquals($jsonObjProject->{'id'}, $projectObj->getId());
            $this->assertEquals($jsonObjProject->{'name'}, $projectObj->getName());
        }

    }
}


?>