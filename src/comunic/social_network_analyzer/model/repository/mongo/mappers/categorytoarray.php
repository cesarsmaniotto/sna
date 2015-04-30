<?php

namespace comunic\social_network_analyzer\model\repository\mongo\mappers{

    class CategoryToArray{

        public function __invoke($obj){
            $arrayData = array(
                '_id' => new \MongoId($obj->getId()),
                'name' => $obj->getName(),
                'keywords' => $obj->getKeywords()

                );
            return $arrayData;
        }


    }



}



?>