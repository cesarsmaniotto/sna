<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

    class CategoryToArray{

        public function __invoke($obj){
            return array(
                '_id' => new \MongoId($obj->getId()),
                'name' => $obj->getName(),
                'keywords' => $obj->getKeywords(),
                'included' => $obj->getIncluded(),
                'excluded' => $obj->getExcluded()

                );
        }


    }



}



?>