<?php

namespace sna\tests\model\entity\format\json{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\Project;
    use comunic\social_network_analyzer\model\entity\Dataset;
    use comunic\social_network_analyzer\model\entity\format\json\JsonProjectFormatter;

    class JsonProjectFormatterTest extends PHPUnit_Framework_TestCase{

        protected $format;

        protected function setUp(){
            $this->formattter = new JsonProjectFormatter();

        }

        public function testFormat(){
            $project = new Project();
            $project->setId("54202c79d1c82dc01a000034");
            $project->setName("FooProject");
            $project->setDatasetsIds("54202c79d1c82dc01a000032");

            $expectjson = '{"name":"FooProject","datasetsIds":"54202c79d1c82dc01a000032","id":"54202c79d1c82dc01a000034"}';
            $result = $this->formattter->format($project);

            $this->assertEquals($expectjson,$result);


        }



    }
}




?>