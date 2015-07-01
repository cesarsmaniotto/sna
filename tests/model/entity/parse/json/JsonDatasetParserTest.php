<?php

namespace sna\tests\model\entity\parse\json{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\parse\json\JsonDatasetParser;
    use comunic\social_network_analyzer\model\entity\Dataset;
    use comunic\social_network_analyzer\model\util\IdMongoGenerator;

    class JsonDatasetParserTest extends PHPUnit_Framework_TestCase{

        public function testParse(){

            $jsonTextDataset = '{"id":"54202c79d1c82dc01a000032","name":"FooDataset"}';
            $jsonObjDataset = \json_decode($jsonTextDataset);

            $idMongoGen = new IdMongoGenerator();

            $parser = new JsonDatasetParser($idMongoGen());
            $objDataset = $parser->parse($jsonTextDataset);

            $this->assertEquals($jsonObjDataset->{'id'}, $objDataset->getId());
            $this->assertEquals($jsonObjDataset->{'name'}, $objDataset->getName());




            $jsonTextDataset = '{"name":"BarDataset"}';
            $jsonObjDataset = \json_decode($jsonTextDataset);

            $parser = new JsonDatasetParser($idMongoGen());
            $objDataset = $parser->parse($jsonTextDataset);

            $this->assertNotEquals("54202c79d1c82dc01a000032", $objDataset->getId());
            $this->assertEquals($jsonObjDataset->{'name'}, $objDataset->getName());

        }


    }

}


?>