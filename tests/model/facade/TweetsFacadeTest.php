<?php

namespace sna\tests\model\facade{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\facade\TweetsFacade;
    use comunic\social_network_analyzer\model\repository\mongo\TweetsRepository;
    use comunic\social_network_analyzer\model\repository\mongo\CategoriesRepository;
    use comunic\social_network_analyzer\model\entity\Tweet;
    use comunic\social_network_analyzer\model\entity\format\json\JsonTweetFormatter;
    use comunic\social_network_analyzer\model\entity\parse\json\JsonTweetParser;
    use comunic\social_network_analyzer\model\util\IdMongoGenerator;

    use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
    use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;

    class CategoriesFacadeTest extends PHPUnit_Framework_TestCase{

        const DEFAULT_DATABASE = "development";

        protected $connection;
        protected $dataset;
        protected $fixture ;

        protected $facade;
        protected $tweetsRepo;
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
            $this->tweetsRepo = new TweetsRepository(static::DEFAULT_DATABASE);

            $this->facade = new TweetsFacade($this->tweetsRepo, $this->catRepo);

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

public function testInsertAll(){
 $tweetAsText ='[{"text":"FooText","toUserId":null,"fromUser":"mpl_sp","idTweet":"553315797247217664","fromUserId":null,"isoLanguageCode":null,"source":null,"profileImageUrl":null,"geoType":null,"geoCoordinates0":null,"geoCoordinates1":null,"createdAt":"Thu Jan 08 22:22:20 +0000 2015","time":"1420755740"},{"text":"Luta contra a tarifa em Maua, Grande Sao Paulo","toUserId":null,"fromUser":"mpl_sp","idTweet":"553315797247217664","fromUserId":null,"isoLanguageCode":null,"source":null,"profileImageUrl":null,"geoType":null,"geoCoordinates0":null,"geoCoordinates1":null,"createdAt":"Thu Jan 08 22:22:20 +0000 2015","time":"1420755740"}]';



 $parser = new JsonTweetParser();
 $this->facade->insertAll($tweetAsText, $parser);

 $this->assertEquals(1, $this->connection->collection("tweets")->count(["text" => "FooText"]));
 $this->assertEquals(1, $this->connection->collection("tweets")->count(["text" => "Luta contra a tarifa em Maua, Grande Sao Paulo"]));
 $this->assertEquals(\count($this->tweetsRepo->listAll()), $this->connection->collection("tweets")->count());
}

public function testListAll(){
    $tweets = $this->tweetsRepo->listAll();

    $formatter = new JsonTweetFormatter();

    $this->assertEquals($formatter->format($tweets), $this->facade->listAll($formatter));
}

public function testFindById(){
    $tweet = $this->tweetsRepo->findById("54202c79d1c82dc01a000032");

    $formatter = new JsonTweetFormatter();

    $this->assertEquals($formatter->format($tweet), $this->facade->findById("54202c79d1c82dc01a000032",$formatter));
}

public function testFindInAnInterval(){
    $this->markTestSkipped();
}

public function testFindByCategory(){
    $this->markTestSkipped();
}


}


}

?>