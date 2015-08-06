<?php

namespace comunic\social_network_analyzer\model\entity\parse\csv {

    use comunic\social_network_analyzer\model\entity\parse\csv\BasicCSVObjectParser;
    use comunic\social_network_analyzer\model\entity\Tweet;

    class CSVTweetParser extends BasicCSVObjectParser {

     protected function arrayToObject($arrayData){

       $tweet = new Tweet();

       $tweet->setText($arrayData['text']);
       $tweet->setToUserId($arrayData['to_user_id']);
       $tweet->setFromUser($arrayData['from_user']);
       $tweet->setIdTweet($arrayData['id']);
       // $tweet->setId($arrayData['id']);
       $tweet->setFromUserId($arrayData['from_user_id']);
       $tweet->setIsoLanguageCode($arrayData['iso_language_code']);
       $tweet->setSource($arrayData['source']);
       $tweet->setProfileImageUrl($arrayData['profile_image_url']);
       $tweet->setGeoType($arrayData['geo_type']);
       $tweet->setGeoCoordinates0($arrayData['geo_coordinates_0']);
       $tweet->setGeoCoordinates1($arrayData['geo_coordinates_1']);
       $tweet->setCreatedAt($arrayData['created_at']);
       $tweet->setTime($arrayData['time']);

       return $tweet;

   }

}

}