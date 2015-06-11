<?php

namespace sna\tests\model\entity{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\entity\Project;

class ProjectTest extends PHPUnit_Framework_TestCase{

    protected $project;

    protected function setUp(){
        $this->project = new Project();
    }

    public function testName(){

        $this->project->setName("Name");

        $this->assertEquals("Name", $this->project->getName());


    }


    public function testId(){

        $this->project->setId("123456");

        $this->assertEquals("123456", $this->project->getId());


    }

}
}




?>