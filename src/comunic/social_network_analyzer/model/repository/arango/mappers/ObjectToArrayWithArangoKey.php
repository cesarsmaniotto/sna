<?php

namespace comunic\social_network_analyzer\model\repository\arango\mappers{

    class ObjectToArrayWithArangoKey{

        public function __invoke($obj, $objToArray){

            $fObjToArray = $objToArray;

            $arrayData = $fObjToArray($obj);

            // unset($arrayData["id"]);

            if($obj->getId() != null){
            	$arrayData["_key"] = $obj->getId();
            }            

            return $arrayData;
        }


    }



}



?>