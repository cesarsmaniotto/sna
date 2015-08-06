<?php

namespace comunic\social_network_analyzer\model\repository\arango\mappers{


    class ArrayWithArangoKeyToObject{

        public function __invoke($arrayData, $arrayToObj){

            $fArrayToObj = $arrayToObj;

            $obj = $fArrayToObj($arrayData);

            if(isset($arrayData['_key'])){
            	$obj->setId($arrayData['_key']);
            }           

            return $obj;



        }


    }



}



?>