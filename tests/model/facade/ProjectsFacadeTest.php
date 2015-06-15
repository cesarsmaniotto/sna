<?php

namespace sna\tests\model\facade{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\facade\ProjectsFacade;
use comunic\social_network_analyzer\model\repository\mongo\ProjectsRepository;

class ProjectsFacadeTest extends PHPUnit_Framework_TestCase{

    protected $facade;
    protected $repository;

    public function setUp(){
        $this->repository = new ProjectsRepository();
        $this->facade = new ProjectsFacade($this->repository);
    }


}


}

?>