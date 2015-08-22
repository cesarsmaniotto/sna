<?php


namespace comunic\social_network_analyzer\model\entity\mappers{

    class TweetToArray{

        public function __invoke($obj){
         
            return array(
                
                'text' => $obj->getText(),
                'toUserId' => $obj->getToUserId(),
                'fromUser' => $obj->getFromUser(),
                'id' => $obj->getId(),
                'fromUserId' => $obj->getFromUserId(),
                'isoLanguageCode' => $obj->getIsoLanguageCode(),
                'source' => $obj->getSource(),
                'profileImageUrl' => $obj->getProfileImageUrl(),
                'geoType' => $obj->getGeoType(),
                'geoCoordinates0' => $obj->getGeoCoordinates0(),
                'geoCoordinates1' => $obj->getGeoCoordinates1(),
                'createdAt' => $obj->getCreatedAt(),
                'time' => $obj->getTime()

                );



        }

    }




}



?>