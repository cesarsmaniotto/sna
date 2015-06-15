<?php

namespace sna\tests\model\entity\mappers\ArrayToProjectTest{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToProject;

    class ArrayToProjectTest extends PHPUnit_Framework_TestCase{


        public function testInvoke(){
            $projectArray = array(
                "_id" => new \MongoId("54202c79d1c82dc01a000034"),
                "name" => "FooProject"
                );

            $farrayToProject = new ArrayToProject();
            $projectObj = $farrayToProject($projectArray);

            $this->assertEquals("54202c79d1c82dc01a000034", $projectObj->getId());
            $this->assertEquals("FooProject",$projectObj->getName());
        }

    }



}


?>