<?php

namespace sna\tests\model\repository\mongo{

use PHPUnit_Framework_TestCase;
use comunic\social_network_analyzer\model\repository\mongo\DatasetsRepository;

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
        $datasetObj = new Dataset();
        $datasetObj->setName("aDataset");

        $this->repository->insert($datasetObj);

        $result = $this->dataset->collection("datasets")->findOne(array("name" => "aDataset"));

        $this->assertEquals($datasetObj->getName(), $result['name']);

    }

    public function testUpdate(){
        $datasetObj = new Dataset();
        $datasetObj->setId("54202c79d1c82dc01a000032");
        $datasetObj->setName("new name Dataset");

        $this->repository->update($datasetObj);

        $result = $this->dataset->collection("datasets")->findOne(array("_id" => new \MongoId("54202c79d1c82dc01a000032")));

        $this->assertEquals($datasetObj->getId(), $result['_id']->{'id'});
        $this->assertEquals($datasetObj->getName(), $result['name']);

    }

    public function testDelete(){
        $this->assertEquals(2, $this->dataset->collection('datasets')->count());

        $this->repository->delete("54202c79d1c82dc01a000032");

        $this->assertEquals(1, $this->dataset->collection('datasets')->count());
        $this->assertNotEquals(0, $this->dataset->collection('datasets')->count());
        $this->assertNotEquals(2, $this->dataset->collection('datasets')->count());


    }

    public function testFindOne(){

        $datasetObj = $this->repository>findOne("54202c79d1c82dc01a000032");

        $this->assertEquals("FooDataset", $datasetObj->getName());
        $this->assertEquals("44202c79d1c82dc01a000032", $datasetObj->getProjectId());
    }

    public function testListAll(){

        $results = $this->repository->listAll();

        $this->assertEquals(\count($results), $this->dataset->collection('datasets')->count());
        $this->assertNotEquals(\count($results)-1, $this->dataset->collection('datasets')->count());
        $this->assertNotEquals(\count($results)+1, $this->dataset->collection('datasets')->count());

    }


}



}

?>