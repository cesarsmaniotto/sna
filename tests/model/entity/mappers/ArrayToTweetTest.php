<?php

namespace sna\tests\model\entity\mappers{

    use PHPUnit_Framework_TestCase;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToTweet;


    class ArrayToTweetTest extends PHPUnit_Framework_TestCase{


        public function testInvoke(){
            $tweetAsArray = array(
                "_id" => new \MongoId("54202c79d1c82dc01a000034"),
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
                'geoCoordinates1' => null
                );

            $farrayToTweet = new ArrayToTweet();

            $tweetAsObj = $farrayToTweet($tweetAsArray);


            $this->assertEquals($tweetAsArray['_id']->{'$id'}, $tweetAsObj->getId());
            $this->assertEquals($tweetAsArray['text'],$tweetAsObj->getText());
            $this->assertEquals($tweetAsArray['fromUser'],$tweetAsObj->getFromUser());
        }

    }



}


?>