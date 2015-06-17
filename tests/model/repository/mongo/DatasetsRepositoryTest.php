<?php

namespace sna\tests\model\repository\mongo{

use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\repository\mongo\DatasetsRepository;
use comunic\social_network_analyzer\model\entity\Dataset as DatasetModel;

class DatasetsRepositoryTest extends PHPUnit_Framework_TestCase{

     const DEFAULT_DATABASE = "teste";

        protected $connection;
        protected $dataset;
        protected $fixture ;

        protected $repository;

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
            $this->repository = new DatasetsRepository();

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
                    )
                );

            $this->getMongoConnection();
            $this->getMongoDataSet();
        }

        public function tearDown(){
            $this->dataset->dropAllCollections();
        }

    public function testInsert(){
        $datasetObj = new DatasetModel();
        $datasetObj->setName("aDataset");

        $this->repository->insert($datasetObj);

        $result = $this->connection->collection("datasets")->findOne(array("name" => "aDataset"));

        $this->assertEquals($datasetObj->getName(), $result['name']);

    }

    public function testUpdate(){
        $datasetObj = new DatasetModel();
        $datasetObj->setId("54202c79d1c82dc01a000032");
        $datasetObj->setName("new name Dataset");

        $this->repository->update($datasetObj);

        $result = $this->connection->collection("datasets")->findOne(array("_id" => new \MongoId("54202c79d1c82dc01a000032")));

        $this->assertEquals($datasetObj->getId(), $result['_id']->{'$id'});
        $this->assertEquals($datasetObj->getName(), $result['name']);

    }

    public function testDelete(){
        $this->assertEquals(2, $this->connection->collection('datasets')->count());
        $this->repository->delete("54202c79d1c82dc01a000032");

        $this->assertEquals(1, $this->connection->collection('datasets')->count());
        $this->assertNotEquals(0, $this->connection->collection('datasets')->count());
        $this->assertNotEquals(2, $this->connection->collection('datasets')->count());


    }

    public function testListAll(){

        $results = $this->repository->listAll();

        $this->assertEquals(\count($results), $this->connection->collection('datasets')->count());
        $this->assertNotEquals(\count($results)-1, $this->connection->collection('datasets')->count());
        $this->assertNotEquals(\count($results)+1, $this->connection->collection('datasets')->count());

    }

    public function testFindById(){

        $datasetObj = $this->repository->findById("54202c79d1c82dc01a000032");

        $this->assertEquals("FooDataset", $datasetObj->getName());
    }


}



}

?>