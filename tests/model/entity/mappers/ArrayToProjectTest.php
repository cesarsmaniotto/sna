<?php

namespace sna\tests\model\entity\mappers\ArrayToProjectTest{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToProject;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;

    class ArrayToProjectTest extends PHPUnit_Framework_TestCase{


        public function testInvoke(){
            $projectArray = array(
                "_id" => new \MongoId("54202c79d1c82dc01a000034"),
                "name" => "FooProject",
                "datasets" => array(
                                        array("_id" => new \MongoId("54202c79d1c82dc01a000032"),
                                        "name" => "FooDataset")
                                        )
                );

            $farrayToProject = new ArrayToProject();
            $farrayToDataset = new ArrayToDataset();
            $projectObj = $farrayToProject($projectArray);
            $datasetObj = $farrayToDataset($projectArray['datasets'][0]);

            $this->assertEquals("54202c79d1c82dc01a000034", $projectObj->getId());
            $this->assertEquals("FooProject",$projectObj->getName());
            $this->assertEquals($datasetObj,$projectObj->getDatasets()[0]);
        }

    }



}


?>