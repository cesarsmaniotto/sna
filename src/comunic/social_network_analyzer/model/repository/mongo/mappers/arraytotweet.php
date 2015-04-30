<?php

namespace comunic\social_network_analyzer\model\repository\mongo\mappers{

    use \comunic\social_network_analyzer\model\entity\Tweet;

    class ArrayToTweet{

        public function __invoke($arrayData){

            $tweet = new Tweet();


            $tweet->setId($arrayData['_id']->{'$id'});
            $tweet->setText($arrayData['text']);
            $tweet->setToUserId($arrayData['toUserId']);
            $tweet->setFromUser($arrayData['fromUser']);
            $tweet->setIdTweet($arrayData['fromUserId']);
            $tweet->setFromUserId($arrayData['fromUserId']);
            $tweet->setIsoLanguageCode($arrayData['isoLanguageCode']);
            $tweet->setSource($arrayData['source']);
            $tweet->setProfileImageUrl($arrayData['profileImageUrl']);
            $tweet->setGeoType($arrayData['geoType']);
            $tweet->setGeoCoordinates0($arrayData['geoCoordinates0']);
            $tweet->setGeoCoordinates1($arrayData['geoCoordinates1']);
            $tweet->setCreatedAt($arrayData['createdAt']);
            $tweet->setTime($arrayData['time']);

            return $tweet;
        }


    }




}



?>