<?php

namespace sna\tests\model\entity\mappers{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\Tweet;
    use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;
    use comunic\social_network_analyzer\model\util\IdMongoGenerator;

    class TweetToArrayTest extends PHPUnit_Framework_TestCase{


        public function testeInvoke(){

            $tweet = new Tweet();
            $idMongo=new IdMongoGenerator();
            $tweetId = $idMongo();
            $tweet->setId($tweetId);
            $tweet->setText("Luta contra a tarifa em Mauá, Grande São Paulo: https://t.co/cYFaM8fWmD http://t.co/EifkoRBnXN");
            $tweet->setFromUser("mpl_sp");
            $tweet->setIdTweet("553315797247217664");
            $tweet->setCreatedAt("Thu Jan 08 22:22:20 +0000 2015");
            $tweet->setTime("1420755740");

            $expectedArray = array(
                "_id" => $tweetId,
                "text" => "Luta contra a tarifa em Mauá, Grande São Paulo: https://t.co/cYFaM8fWmD http://t.co/EifkoRBnXN",
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
                'geoCoordinates1' => null,

                );

            $fTweetToArray = new TweetToArray();

            $this->assertEquals($expectedArray, $fTweetToArray($tweet));

        }

    }

}

?>