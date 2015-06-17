<?php

namespace sna\tests\model\entity\format\json\JsonDatasetFormatterTest{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\entity\Dataset;
use comunic\social_network_analyzer\model\entity\format\json\JsonDatasetFormatter;

class JsonDatasetFormatterTest extends PHPUnit_Framework_TestCase{

    public function testFormat(){

        $expectJson = '{"name":"FooDataset","id":"54202c79d1c82dc01a000032"}';
        $dataset = new Dataset();

        $dataset->setId("54202c79d1c82dc01a000032");
        $dataset->setName("FooDataset");

        $formatter = new JsonDatasetFormatter();

        $resultJson = $formatter->format($dataset);

        $this->assertEquals($expectJson, $resultJson);


    }

}


}

?>