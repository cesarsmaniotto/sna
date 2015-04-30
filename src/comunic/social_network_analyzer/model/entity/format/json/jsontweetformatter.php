<?php

namespace comunic\social_network_analyzer\model\entity\format\json{

    use \comunic\social_network_analyzer\model\entity\format\IObjectFormatter;


    class JsonTweetFormatter implements IObjectFormatter{

        public function format($obj){

            if(\is_array($obj)){

                foreach ($obj as $item) {

                    $data = array();

                    $data[]=$this->toMap($item);

                }

                return \json_encode($data);

            }

            return \json_encode($this->toMap($obj));

        }

    private function toMap($obj){

        return array(
                'id' => $obj->getId(),
                'text' => $obj->getText(),
                'toUserId' => $obj->getToUserId(),
                'fromUser' => $obj->getFromUser(),
                'idTweet' => $obj->getIdTweet(),
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