<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use comunic\social_network_analyzer\model\entity\Dataset;
    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;

    class JsonDatasetParser implements IObjectParser{


        public function parse($text){

            $jsondataset = \json_decode($text);
            $dataset = new Dataset();

             if (isset($jsondataset->id)) {
                $dataset->setId($jsondataset->id);
            }

            if (isset($jsondataset->name)) {
                $dataset->setName($jsondataset->name);
            }

            return $dataset;

        }

    }

}

?>