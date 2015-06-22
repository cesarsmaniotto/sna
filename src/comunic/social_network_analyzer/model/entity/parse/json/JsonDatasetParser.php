<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use comunic\social_network_analyzer\model\entity\Dataset;
    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;
    use comunic\social_network_analyzer\model\util\IdGenerator;

    class JsonDatasetParser implements IObjectParser{


        public function parse($text, $idGenerator=null){

            $jsondataset = \json_decode($text);
            $dataset = new Dataset();

             if (isset($jsondataset->id)) {
                $dataset->setId($jsondataset->id);
            }else{
                $dataset->setId($idGenerator);
            }

            if (isset($jsondataset->name)) {
                $dataset->setName($jsondataset->name);
            }

            return $dataset;

        }

    }

}

?>