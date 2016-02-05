<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;
    use comunic\social_network_analyzer\model\util\ArrayUtil;

    class BasicObjectParser implements IObjectParser{

        private $funcToObj;

        function __construct($funcToObj){
            $this->funcToObj = $funcToObj();
        }

        public function parse($jsonText){

            $arrayData = \json_decode($jsonText, true);

            if(ArrayUtil::is_assoc_array($arrayData)){

                return $this->funcToObj($arrayData);

            }

            if(\is_array($arrayData)){

                $listObjects = array();

                foreach ($arrayData as $item) {
                    $listObjects[] = $this->funcToObj($item);
                }

                return $listObjects;

            }
        }
    }
}

?>