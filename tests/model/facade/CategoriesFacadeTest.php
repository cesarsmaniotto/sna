<?php

namespace sna\tests\model\facade{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\facade\CategoriesFacade;
    use comunic\social_network_analyzer\model\repository\mongo\CategoriesRepository;
    use comunic\social_network_analyzer\model\entity\Category;
    use comunic\social_network_analyzer\model\entity\format\json\JsonCategoryFormatter;
    use comunic\social_network_analyzer\model\entity\parse\json\JsonCategoryParser;
    use comunic\social_network_analyzer\model\util\IdMongoGenerator;

    use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
    use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;

    class CategoriesFacadeTest extends PHPUnit_Framework_TestCase{

        const DEFAULT_DATABASE = "development";

        protected $connection;
        protected $dataset;
        protected $fixture ;

        protected $facade;
        protected $catRepo;

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
            $this->catRepo = new CategoriesRepository(static::DEFAULT_DATABASE);
            $this->facade = new CategoriesFacade($this->catRepo);

            $this->fixture = array(
                "categories" => array(
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000032"),
                        "name" => "FooCategory",
                        "keywords" => array("FooKw", "BarKw"),
                        "included" => null,
                        "excluded" => null
                        ),
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000033"),
                        "name" => "BarCategory",
                        "keywords" => array("FooKw", "BarKw"),
                        "included" => null,
                        "excluded" => null
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

            $categoryAsText = '{"name":"New Category","keywords":["FooKw","BarKw"],"included":null,"excluded":null}';


            $parser = new JsonCategoryParser();
            $this->facade->update($categoryAsText, $parser);

            $this->assertEquals(1, $this->connection->collection("categories")->count(["name" => "New Category"]));
        }

         public function testUpdate(){
            $idMongoGen = new IdMongoGenerator();
            $catId = $idMongoGen();

            $categoryAsText = '{"name":"FooCategory","keywords":["FooKw","BarKw"],"included":null,"excluded":null,"id":"'.$catId.'"}';


            $parser = new JsonCategoryParser();
            $this->facade->update($categoryAsText, $parser);

            $this->assertEquals($parser->parse($categoryAsText), $this->catRepo->findById($catId));



        }

        public function testDelete(){

            $this->assertEquals(2, $this->connection->collection('categories')->count());

            $this->facade->delete("54202c79d1c82dc01a000032");

            $this->assertEquals(1, $this->connection->collection('categories')->count());

        }

        public function testListAll(){
            $categories = $this->catRepo->listAll();

            $formatter = new JsonCategoryFormatter();

            $this->assertEquals($formatter->format($categories), $this->facade->listAll($formatter));
        }

        public function testFindById(){
            $category = $this->catRepo->findById("54202c79d1c82dc01a000032");

            $formatter = new JsonCategoryFormatter();

            $this->assertEquals($formatter->format($category), $this->facade->findById("54202c79d1c82dc01a000032",$formatter));
        }


    }


}

?>