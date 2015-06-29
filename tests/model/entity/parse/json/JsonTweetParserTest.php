<?php

namespace sna\tests\model\entity\mappers{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\Tweet;
    use comunic\social_network_analyzer\model\entity\parse\json\JsonTweetParser;
    use comunic\social_network_analyzer\model\util\IdMongoGenerator;

    class JsonTweetParserTest extends PHPUnit_Framework_TestCase{

        public function testParse(){

            $tweet = new Tweet();
            $idMongo=new IdMongoGenerator();
            $tweetId = $idMongo();
            $tweet->setId($tweetId);
            $tweet->setText("Luta contra a tarifa em Maua, Grande Sao Paulo");
            $tweet->setFromUser("mpl_sp");
            $tweet->setIdTweet("553315797247217664");
            $tweet->setCreatedAt("Thu Jan 08 22:22:20 +0000 2015");
            $tweet->setTime("1420755740");

            $tweetAsText ='[{"text":"Luta contra a tarifa em Maua, Grande Sao Paulo","toUserId":null,"fromUser":"mpl_sp","idTweet":"553315797247217664","fromUserId":null,"isoLanguageCode":null,"source":null,"profileImageUrl":null,"geoType":null,"geoCoordinates0":null,"geoCoordinates1":null,"createdAt":"Thu Jan 08 22:22:20 +0000 2015","time":"1420755740","id":"'.$tweetId.'"}]';

            $parser = new JsonTweetParser();

            $this->assertEquals($tweet, $parser->parse($tweetAsText)[0]);


        }

    }

}

?>