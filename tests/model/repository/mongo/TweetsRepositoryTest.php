<?php


namespace sna\tests\model\repository\mongo{

    use PHPUnit_Framework_TestCase;

    use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
    use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;

    use comunic\social_network_analyzer\model\repository\mongo\TweetsRepository;
    use comunic\social_network_analyzer\model\entity\Tweet;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToTweet;

    class TweetsRepositoryTest extends PHPUnit_Framework_TestCase{

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
            $this->repo = new TweetsRepository(static::DEFAULT_DATABASE);

            $this->fixture = array(
                "tweets" => array(
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000032"),
                        "text" => "Luta contra a tarifa em Maua, Grande São Paulo",
                        "fromUserId" => null,
                        "idTweet" => "553315797247217664",
                        "createdAt" => "Thu Jan 08 22:22:20 +0000 2015",
                        "time" => "1420755740",
                        'toUserId' => null,
                        'fromUser' => "mpl_sp",
                        'isoLanguageCode' => null,
                        'source' => null,
                        'profileImageUrl' => null,
                        'geoType' => null,
                        'geoCoordinates0' => null,
                        'geoCoordinates1' => null
                        ),
                    array(
                        "_id" => new \MongoId("54202c79d1c82dc01a000033"),
                        "text" => "Luta contra a tarifa em Niteroi, Rio de Janeiro",
                        "fromUserId" => null,
                        "idTweet" => "553315797247217665",
                        "createdAt" => "Thu Jan 08 22:22:20 +0000 2015",
                        "time" => "1420755740",
                        'toUserId' => null,
                        'fromUser' => "mpl_rj",
                        'isoLanguageCode' => null,
                        'source' => null,
                        'profileImageUrl' => null,
                        'geoType' => null,
                        'geoCoordinates0' => null,
                        'geoCoordinates1' => null
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

    $tweet = $this->repo->findById("54202c79d1c82dc01a000032");

    $this->assertEquals("54202c79d1c82dc01a000032", $tweet->getId());
    $this->assertEquals("Luta contra a tarifa em Maua, Grande São Paulo", $tweet->getText());

    $this->assertNotEquals("54202c79d1c82dc01a000031", $tweet->getId());

}


public function testInsert(){
    $tweet = new Tweet();
    $tweet->setText("Luta contra a tarifa em Salvador, Bahia");

    $this->repo->insert($tweet);

    $result = $this->connection->collection('tweets')->findOne(['text' => "Luta contra a tarifa em Salvador, Bahia"]);

    $this->assertEquals($tweet->getText(), $result['text']);

}


public function testListAll(){
    $count = $this->connection->collection('tweets')->count();
    $this->assertEquals(2, $count);

    $this->assertEquals(2,count($this->repo->listAll()));

    $this->assertNotEquals($count+1, count($this->repo->listAll()));

}





}
}



?>
