<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

    use comunic\social_network_analyzer\model\entity\Dataset;

    class ArrayToDataset{

        function __invoke($arrayData){

            $dataset = new Dataset();

            $dataset->setId($arrayData["_id"]->{'$id'});
            $dataset->setName($arrayData["name"]);

            return $dataset;

        }

    }

}

?>