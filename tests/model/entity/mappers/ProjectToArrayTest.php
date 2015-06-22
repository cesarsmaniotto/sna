<?php

namespace sna\tests\model\entity\mappers\ProjectToArrayTest{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\mappers\ProjectToArray;
    use comunic\social_network_analyzer\model\entity\Project;
    use comunic\social_network_analyzer\model\entity\Dataset;
    class ProjectToArrayTest extends PHPUnit_Framework_TestCase{


        public function testInvoke(){
            $arrayExpected = array(
                "_id" => new \MongoId("54202c79d1c82dc01a000034"),
                "name" => "FooProject",
                "datasets"=> array(
                                        array("_id" => new \MongoId("54202c79d1c82dc01a000032"),
                                        "name" => "FooDataset")
                                        )
                );

            $project = new Project();
            $project->setId("54202c79d1c82dc01a000034");
            $project->setName("FooProject");
            $dataset = new Dataset();
            $dataset->setId("54202c79d1c82dc01a000032");
            $dataset->setName("FooDataset");
            $project->setDatasets(array($dataset));

            $fProjectToArray = new ProjectToArray();
            $arrayResult = $fProjectToArray($project);

            $this->assertEquals($arrayExpected, $arrayResult);

        }

    }



}


?>