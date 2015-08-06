<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

    class DatasetToArray{

        function __invoke($obj){

            return array(
                "id" => $obj->getId(),
                "name" => $obj->getName(),
                "hasTweets" => $obj->getHasTweets()
                );
        }

    }

}


?>