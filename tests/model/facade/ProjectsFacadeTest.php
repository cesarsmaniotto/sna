<?php

namespace sna\tests\model\facade{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\facade\ProjectsFacade;
    use comunic\social_network_analyzer\model\repository\mongo\ProjectsRepository;
    use comunic\social_network_analyzer\model\repository\mongo\DatasetsRepository;
    use comunic\social_network_analyzer\model\entity\Dataset as DatasetModel;
    use comunic\social_network_analyzer\model\entity\format\json\JsonDatasetFormatter;
    use comunic\social_network_analyzer\model\entity\format\json\JsonProjectFormatter;
    use comunic\social_network_analyzer\model\entity\parse\json\JsonProjectParser;

    use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
    use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;

    class ProjectsFacadeTest extends PHPUnit_Framework_TestCase{

        const DEFAULT_DATABASE = "development";

        protected $connection;
        protected $dataset;
        protected $fixture ;

        protected $facade;
        protected $projectRepo;
        protected $datasetRepo;


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
            $this->projectRepo = new ProjectsRepository(static::DEFAULT_DATABASE);
            $this->datasetRepo = new DatasetsRepository(static::DEFAULT_DATABASE);
            $this->facade = new ProjectsFacade($this->projectRepo, $this->datasetRepo);

            $this->fixture = array(
                "datasets" => array(
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000032"),
                        "name" => "FooDataset",
                        ),
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000033"),
                        "name" => "BarDataset",
                        )
                    ),

                "projects" => array(
                    array(
                        "_id" => new \MongoId("14202c79d1c82dc01a000032"),
                        "name" => "FooProject",
                        "datasetsIds" => array("54202c79d1c82dc01a000032","54202c79d1c82dc01a000033")
                        )
                    )

                );

            $this->getMongoConnection();
            $this->getMongoDataSet();
        }

        public function tearDown(){
            $this->dataset->dropAllCollections();
        }

        public function testGetDatasets(){

            $datasetsArrayExpected = $this->datasetRepo->findById(array("54202c79d1c82dc01a000032","54202c79d1c82dc01a000033"));
            $formatter = new JsonDatasetFormatter();

            $this->assertEquals($formatter->format($datasetsArrayExpected), $this->facade->getDatasets("14202c79d1c82dc01a000032",$formatter));

        }

        public function testInsert(){

            $projectAsText =  '{"name":"BarProject","datasetsIds":"54202c79d1c82dc01a000032"}';

            $parser = new JsonProjectParser();
            $this->facade->insert($projectAsText, $parser);

            $this->assertEquals(1, $this->connection->collection('projects')->count(array("name" => "BarProject")));

        }

        public function testUpdate(){

            $projectAsText =  '{"name":"BarProject","datasetsIds":"54202c79d1c82dc01a000032","id":"54202c79d1c82dc01a000035"}';

            $parser = new JsonProjectParser();
            $this->facade->insert($projectAsText, $parser);

            $this->assertEquals($parser->parse($projectAsText), $this->projectRepo->findById("54202c79d1c82dc01a000035"));

        }

        public function testDelete(){

            $this->assertEquals(1, $this->connection->collection('projects')->count());

            $this->facade->delete("14202c79d1c82dc01a000032");

            $this->assertEquals(0, $this->connection->collection('projects')->count());

        }

        public function testListAll(){
            $projects = $this->projectRepo->listAll();

            $formatter = new JsonProjectFormatter();

            $this->assertEquals($formatter->format($projects), $this->facade->listAll($formatter));
        }

        public function testFindById(){
            $project = $this->projectRepo->findById("14202c79d1c82dc01a000032");

            $formatter = new JsonProjectFormatter();

            $this->assertEquals($formatter->format($project), $this->facade->findById("14202c79d1c82dc01a000032",$formatter));
        }


    }


}

?>