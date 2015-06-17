<?php

namespace sna\tests\model\entity\mappers{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\mappers\DatasetToArray;
    use comunic\social_network_analyzer\model\entity\Dataset;

    class DatasetToArrayTest extends PHPUnit_Framework_TestCase{

        public function testInvoke(){
            $dataset = new Dataset();

            $expectedArray = array("_id" => new \MongoId("54202c79d1c82dc01a000032"),
                                        "name" => "FooDataset");

            $dataset->setId("54202c79d1c82dc01a000032");
            $dataset->setName("FooDataset");

            $fDatasetToArray = new DatasetToArray();

            $resultArray = $fDatasetToArray($dataset);

            $this->assertEquals($expectedArray, $resultArray);



        }


    }


}


?>