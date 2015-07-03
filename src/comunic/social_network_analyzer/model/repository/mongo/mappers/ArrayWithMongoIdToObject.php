<?php

namespace comunic\social_network_analyzer\model\repository\mongo\mappers{


    class ArrayWithMongoIdToObject{

        public function __invoke($arrayData, $arrayToObj){

            $fArrayToObj = $arrayToObj;

            $obj = $fArrayToObj($arrayData);

            $obj->setId($arrayData['_id']->{'$id'});

            return $obj;



        }


    }



}



?>