<?php

namespace sna\tests\model\repository\mongo{

    use PHPUnit_Framework_TestCase;

    use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
    use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;

    use comunic\social_network_analyzer\model\repository\mongo\ProjectsRepository;
    use comunic\social_network_analyzer\model\entity\Project;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToProject;

    class ProjectsRepositoryTest extends PHPUnit_Framework_TestCase{

        const DEFAULT_DATABASE = "teste";

        protected $connection;
        protected $dataset;
        protected $fixture ;

        protected $repo;

        public function getMongoConnection() {
            if (empty($this->connection)) {
                $this->connection = new Connector(new \MongoClient());
                $this->connection->setDb(static::DEFAULT_DATABASE);
            }
            return $this->connection;
        }
        public function getMongoDataSet() {
            if (empty($this->dataset)) {
                $this->dataset = new DataSet($this->getMongoConnection());
                $this->dataset->setFixture($this->fixture);
                $this->dataset->buildCollections();
            }
            return $this->dataset;
        }

        public function setUp(){
            $this->repo = new ProjectsRepository();

            $this->fixture = array(
                "projects" => array(
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000032"),
                        "name" => "FooProject"
                        ),
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000033"),
                        "name" => "BarProject"
                        )
                    )
                );

            $this->getMongoConnection();
            $this->getMongoDataSet();
        }

        public function tearDown(){
            $this->dataset->dropAllCollections();
        }

        public function testFindById(){

            $project = $this->repo->findById("54202c79d1c82dc01a000032");

            $this->assertEquals("54202c79d1c82dc01a000032", $project->getId());
            $this->assertEquals("FooProject", $project->getName());

            $this->assertNotEquals("54202c79d1c82dc01a000031", $project->getId());

        }


        public function testUpdate(){
            $project = new Project();
            $project->setId("54202c79d1c82dc01a000034");
            $project->setName("umProjeto");

            $this->repo->insert($project);

            $result = $this->connection->collection('projects')->findOne(['_id' => new \MongoId('54202c79d1c82dc01a000034')]);

            $this->assertEquals($project->getName(), $result['name']);
            $this->assertEquals($project->getId(), $result['_id']->{'$id'});

        }

        public function testInsert(){
            $project = new Project();
            $project->setName("BarProject");

            $this->repo->insert($project);
            $result = $this->connection->collection('projects')->findOne(['name' => "BarProject"]);

            $this->assertEquals($project->getName(), $result['name']);

        }

        public function testDelete(){
            $count = $this->connection->collection('projects')->count();
            $this->assertEquals(2, $count);

            $this->repo->delete("54202c79d1c82dc01a000032");

            $count = $this->connection->collection('projects')->count();
            $this->assertEquals(1, $count);
            $this->assertNotEquals(0, $count);
            $this->assertNotEquals(2, $count);
        }

        public function testListAll(){
            $count = $this->connection->collection('projects')->count();
            $this->assertEquals(2, $count);

            $this->assertEquals(2,count($this->repo->listAll()));

            $this->assertNotEquals($count+1, count($this->repo->listAll()));

        }





    }
}



?>