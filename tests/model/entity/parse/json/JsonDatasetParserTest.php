<?php

namespace sna\tests\model\entity\parse\json{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\parse\JsonDatasetParser;
    use comunic\social_network_analyzer\model\entity\Dataset;

    class JsonDatasetParserTest extends PHPUnit_Framework_TestCase{

        public function testParse(){
            $jsonTextDataset = '{"id":"54202c79d1c82dc01a000032","name":"FooDataset"}';
            $jsonObjDataset = \json_decode($jsonObjDataset);

            $parser = new JsonDatasetParser();
            $objDataset = $parser->parse($jsonTextDataset);

            $this->assertEquals($jsonObjDataset->id, $objDataset->getId());
            $this->assertEquals($jsonObjDataset->name, $objDataset->getName());

        }


    }

}


?>