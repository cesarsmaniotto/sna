<?php

namespace sna\tests\model\entity\mappers{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;
use comunic\social_network_analyzer\model\entity\Dataset;

class ArrayToDatasetTest extends PHPUnit_Framework_TestCase{


    public function testInvoke(){


        $arrayData = array("_id" => new \MongoId("54202c79d1c82dc01a000032"),
                                        "name" => "FooDataset");

        $fArrayToDataset = new ArrayToDataset();
        $dataset = $fArrayToDataset($arrayData);

        $this->assertEquals($arrayData['_id']->{'$id'}, $dataset->getId());
        $this->assertEquals($arrayData['name'], $dataset->getName());

    }


}


}

?>