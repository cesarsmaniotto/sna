<?php

namespace sna\tests\model\entity\mappers\ProjectToArrayTest{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\mappers\ProjectToArray;
    use comunic\social_network_analyzer\model\entity\Project;

    class ProjectToArrayTest extends PHPUnit_Framework_TestCase{


        public function testInvoke(){
            $arrayExpected = array(
                "_id" => new \MongoId("54202c79d1c82dc01a000034"),
                "name" => "FooProject"
                );

            $project = new Project();
            $project->setId("54202c79d1c82dc01a000034");
            $project->setName("FooProject");

            $fProjectToArray = new ProjectToArray();
            $arrayResult = $fProjectToArray($project);

            $this->assertEquals($arrayExpected, $arrayResult);

        }

    }



}


?>