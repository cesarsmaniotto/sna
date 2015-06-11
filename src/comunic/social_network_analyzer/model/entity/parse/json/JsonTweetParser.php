<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use \comunic\social_network_analyzer\model\entity\Tweet;
    use \comunic\social_network_analyzer\model\entity\parse\IObjectParser;

    class JsonTweetParser implements IObjectParser{

        public function parse($text){

            $data = \json_decode($text);

            $tweets = array();

            foreach ($data as $item) {
                $tweets[]=$this->createObject($item);
            }

           return $tweets;

        }

        private function createObject($jsonObj){

            $tweet = new Tweet();


            if(isset($jsonObj->id)){
                $tweet->setId($jsonObj->id);
            }
            if(isset($jsonObj->text)){
                $tweet->setText($jsonObj->text);
            }
            if(isset($jsonObj->toUserId)){
                $tweet->setToUserId($jsonObj->toUserId);
            }
            if(isset($jsonObj->fromUser)){
                $tweet->setFromUser($jsonObj->fromUser);
            }
            if(isset($jsonObj->idTweet)){
               $tweet->setIdTweet($jsonObj->idTweet);
            }
            if(isset($jsonObj->fromUserId)){
                $tweet->setFromUserId($jsonObj->fromUserId);
            }
            if(isset($jsonObj->isoLanguageCode)){
                $tweet->setIsoLanguageCode($jsonObj->isoLanguageCode);
            }
            if(isset($jsonObj->source)){
                $tweet->setSource($jsonObj->source);
            }
            if(isset($jsonObj->profileImageUrl)){
               $tweet->setProfileImageUrl($jsonObj->profileImageUrl);
            }
            if(isset($jsonObj->geoType)){
                $tweet->setGeoType($jsonObj->geoType);
            }
            if(isset($jsonObj->geoCoordinates0)){
                $tweet->setGeoCoordinates0($jsonObj->geoCoordinates0);
            }
            if(isset($jsonObj->geoCoordinates1)){
                $tweet->setGeoCoordinates0($jsonObj->geoCoordinates1);
            }
            if(isset($jsonObj->createdAt)){
               $tweet->setCreatedAt($jsonObj->createdAt);
            }
            if(isset($jsonObj->time)){
                $tweet->setTime($jsonObj->time);
            }




            return $tweet;

        }



    }





}





?>