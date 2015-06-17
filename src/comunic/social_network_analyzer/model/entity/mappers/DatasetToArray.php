<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

    class DatasetToArray{

        function __invoke($obj){

            return array(
                "_id" => new \MongoId($obj->getId()),
                "name" => $obj->getName()
                );
        }

    }

}


?>