<?php

namespace comunic\social_network_analyzer\model\repository\mongo\mappers{

    class ObjectToArrayWithMongoId{

        public function __invoke($obj, $objToArray){

            $fObjToArray = $objToArray;

            $arrayData = $fObjToArray($obj);

            unset($arrayData["id"]);
            $arrayData["_id"] = new \MongoId($obj->getId());

            return $arrayData;
        }


    }



}



?>