<?php

namespace sna\tests\model\entity\mappers{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToProject;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;

    class ArrayToProjectTest extends PHPUnit_Framework_TestCase{


        public function testInvoke(){
            $projectArray = array(
                "_id" => new \MongoId("54202c79d1c82dc01a000034"),
                "name" => "FooProject",
                "datasetsIds" => "54202c79d1c82dc01a000032"
                );

            $farrayToProject = new ArrayToProject();

            $projectObj = $farrayToProject($projectArray);


            $this->assertEquals($projectArray['_id']->{'$id'}, $projectObj->getId());
            $this->assertEquals($projectArray['name'],$projectObj->getName());
            $this->assertEquals($projectArray['datasetsIds'],$projectObj->getDatasetsIds());
        }

    }



}


?>