<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

    use \comunic\social_network_analyzer\model\entity\Tweet;

    class ArrayToTweet{

        public function __invoke($arrayData){

            $tweet = new Tweet();

            if(isset($arrayData['id'])){
                $tweet->setId($arrayData['id']);
            }         
            $tweet->setText(\trim($arrayData['text']));
            $tweet->setIdTweet($arrayData['idTweet']);
            $tweet->setToUserId($arrayData['toUserId']);
            $tweet->setFromUser($arrayData['fromUser']);
            $tweet->setFromUserId($arrayData['fromUserId']);
            $tweet->setIsoLanguageCode($arrayData['isoLanguageCode']);
            $tweet->setSource($arrayData['source']);
            $tweet->setProfileImageUrl($arrayData['profileImageUrl']);
            $tweet->setGeoType($arrayData['geoType']);
            $tweet->setGeoCoordinates0($arrayData['geoCoordinates0']);
            $tweet->setGeoCoordinates1($arrayData['geoCoordinates1']);
            $tweet->setCreatedAt($arrayData['createdAt']);
            $tweet->setTime($arrayData['time']);

            if(isset($arrayData['idDataset'])){
                $tweet->setIdDataset($arrayData['idDataset']);
            }

            if(isset($arrayData['class'])){
                $tweet->setClass($arrayData['class']);
            }

            if(isset($arrayData['text'])){
                $tweet->setTextNormalized($arrayData['text']);
            }

            return $tweet;
        }


    }




}



?>