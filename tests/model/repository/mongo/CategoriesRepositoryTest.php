<?php


namespace sna\tests\model\repository\mongo{

    use PHPUnit_Framework_TestCase;

    use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
    use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;

    use comunic\social_network_analyzer\model\repository\mongo\CategoriesRepository;
    use comunic\social_network_analyzer\model\entity\Category;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToCategory;

    class CategoriesRepositoryTest extends PHPUnit_Framework_TestCase{

        const DEFAULT_DATABASE = "development";

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
            $this->repo = new CategoriesRepository(static::DEFAULT_DATABASE);

            $this->fixture = array(
                "categories" => array(
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000032"),
                        "name" => "FooCategory",
                        "keywords"=> array("FooKw", "BarKw"),
                        "included"=>null,
                        "excluded"=>null
                        ),
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000033"),
                        "name" => "BarCategory",
                        "keywords"=> array("FooKw", "BarKw"),
                        "included"=>null,
                        "excluded"=>null
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

            $category = $this->repo->findById("54202c79d1c82dc01a000032");

            $this->assertEquals("54202c79d1c82dc01a000032", $category->getId());
            $this->assertEquals("FooCategory", $category->getName());

            $this->assertNotEquals("54202c79d1c82dc01a000031", $category->getId());

        }


        public function testUpdate(){
            $category = new Category();
            $category->setId("54202c79d1c82dc01a000034");
            $category->setName("umaCategoria");
            $category->setKeywords(array("umakw","duaskw"));

            $this->repo->insert($category);

            $result = $this->connection->collection('categories')->findOne(['_id' => new \MongoId('54202c79d1c82dc01a000034')]);

            $this->assertEquals($category->getName(), $result['name']);
            $this->assertEquals($category->getId(), $result['_id']->{'$id'});

        }

        public function testInsert(){
            $category = new Category();
            $category->setName("umaCategoria");
            $category->setKeywords(array("umakw","duaskw"));
            $this->repo->insert($category);
            $result = $this->connection->collection('categories')->findOne(['name' => "umaCategoria"]);

            $this->assertEquals($category->getName(), $result['name']);

        }

        public function testDelete(){
            $count = $this->connection->collection('categories')->count();
            $this->assertEquals(2, $count);

            $this->repo->delete("54202c79d1c82dc01a000032");

            $count = $this->connection->collection('categories')->count();
            $this->assertEquals(1, $count);
            $this->assertNotEquals(0, $count);
            $this->assertNotEquals(2, $count);
        }

        public function testListAll(){
            $count = $this->connection->collection('categories')->count();
            $this->assertEquals(2, $count);

            $this->assertEquals(2,count($this->repo->listAll()));

            $this->assertNotEquals($count+1, count($this->repo->listAll()));

        }





    }
}



?>
